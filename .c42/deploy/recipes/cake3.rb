_cset(:app_shared_dirs) { ['/config', '/logs', '/tmp', '/webroot/uploads'] }
_cset(:app_shared_files) { ['/config/app.php'] }

namespace :cake do
	task :setup, :roles => :web, :except => { :no_release => true } do
		if app_shared_dirs
				app_shared_dirs.each { |link| run "#{try_sudo} mkdir -p #{shared_path}#{link} && chmod 777 #{shared_path}#{link}"}
		end
		if app_shared_files
				app_shared_files.each { |link| run "#{try_sudo} touch #{shared_path}#{link} && chmod 777 #{shared_path}#{link}" }
		end
	end
  after "cake:setup", "cake:clear_cache"

  desc 'Blow up all the cache files CakePHP uses, ensuring a clean restart.'
  task :clear_cache do
    # Create TMP folders
    run(%w[
      persistent
      models
      queries
      views
      acl
      blocks
      twigView
    ].map do |f|
      "rm -rf #{shared_path}/tmp/cache/#{f}/*"
    end.join(' && '))
  end
  after 'cake:clear_cache', 'cake:chmod'

  desc 'chmod Cake directories'
  task :chmod do
    run [
      "chmod -R 777 #{shared_path}/tmp",
      "chmod -R 777 #{shared_path}/logs"
    ].join(' && ')
  end

  namespace :migrations do
    desc 'Migrate app'
    task :app do
      run "#{latest_release}/bin/cake Migrations migrate"
    end

    desc 'Migrate all plugins'
    task :plugins do
      token = Time.now.to_i
      migrate_shell = %Q(
<?php
namespace App\\Shell;

use Cake\\Console\\Shell;
use Cake\\Core\\Plugin;

class Capistrano#{token}Shell extends Shell
{
    public function run()
    {
        $plugins = Plugin::loaded();
        foreach ($plugins as $plugin) {
            $this->dispatchShell(
                'Migrations',
                'migrate',
                '-p',
                $plugin
            );
        }
    }
}
      ).strip

      put migrate_shell, "#{latest_release}/src/Shell/Capistrano#{token}Shell.php", :mode => 0755
      run "#{latest_release}/bin/cake Capistrano#{token} run"
      run "rm #{latest_release}/src/Shell/Capistrano#{token}Shell.php"
    end

    desc 'Migrate plugins then app'
    task :all do
        cake.migrations.plugins
        cake.migrations.app
    end
  end

  desc <<-DESC
    Executes a cake shell on the remote server.
    Usage:
      cap cake:shell (lists all the available shells)
  DESC
  task :shell do
    command = variables[:command] || ""
    run "#{latest_release}/bin/cake #{command}"
  end

  desc <<-DESC
    Touches up the released code. This is called by update_code after the basic deploy finishes.

    Any directories deployed from the SCM are first removed and then replaced with
    symlinks to the same directories within the shared location.
  DESC
  task :finalize_update, :roles => :web, :except => { :no_release => true } do
    run "chmod -R g+w #{latest_release}#{app_path}" if fetch(:group_writable, true)

    if app_shared_files
        app_shared_files.each { |link| run "#{try_sudo} rm -rf #{latest_release}#{app_path}/#{link}" }
        app_shared_files.each { |link| run "ln -s #{shared_path}#{link} #{latest_release}#{app_path}#{link}" }
    end

    run "#{latest_release}/bin/cake plugin assets symlink"
  end

  after 'cake:finalize_update', 'cake:migrations:all' unless fetch(:skip_migrations, false)
  after 'cake:finalize_update', 'cake:clear_cache'
end

after 'deploy:setup', 'cake:setup'
after 'deploy:finalize_update', 'cake:finalize_update'
