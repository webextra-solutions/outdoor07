load File.dirname(__FILE__) + '/deploy/recipes/http_auth.rb'
load File.dirname(__FILE__) + '/deploy/recipes/cake3.rb'

set :stages, %w[production preprod]
set :default_stage, 'preprod'

server '', :app, :web, :db, primary: true

set :application, 'Extranet_outdoor07'
set :repository,  'git@github.com:webextra-solutions/outdoor07.git'

set :scm, :git
set :git_enable_submodules, 0
set :deploy_via, :copy
set :copy_cache, true
set :copy_exclude, '.git/*'
set :build_script, 'c42 deploy:install'
set :copy_compression, :bz2
set :ssh_options, {
  :forward_agent => true,
  :port => 2222
}

set :use_sudo, false
set :keep_releases, 3
after 'deploy:restart', 'deploy:cleanup'

set :app_path, '/'
set :user, 'cake3'

task :preprod do
  set :deploy_to, '/home/cake3/public_html'
  set :branch, 'develop'
  set :webhost, 'http://cake3.handisport.org/'

  set :http_auth_users, [%w[demo handisport]]
  set :http_auth_path, app_path
  after 'deploy:finalize_update', 'http_auth:protect'
end

task :production do
  raise 'STOP'
  set :deploy_to, '/home/infostrateges/deployment/prod'
  set :branch, 'master'
  set :webhost, 'https://les-infostrateges.com'
end

# see https://github.com/capistrano/capistrano/blob/master/lib/capistrano/ext/multistage.rb#L22
on :load do
  if stages.include?(ARGV.first)
    find_and_execute_task(ARGV.first) if ARGV.any? { |option| option =~ /-T|--tasks|-e|--explain/ }
  else
    find_and_execute_task(default_stage) if exists?(:default_stage)
  end
end

namespace :check do
  desc 'Make sure local git is in sync with remote.'
  task :revision, roles: %i[web app] do
    unless `git rev-parse HEAD` == `git rev-parse origin/#{branch}` || ENV['SKIP_REVISION_CHECK']
      puts "ERROR: Current branch HEAD is not the same as origin/#{branch}"
      puts 'Run `git push` to sync changes.'
      exit 1
    end
  end
  before 'deploy', 'check:revision'
  before 'deploy:migrations', 'check:revision'
  before 'deploy:cold', 'check:revision'
end

namespace :handisport do

end


after :deploy do
  run "echo #{latest_revision} > #{File.join(latest_release, app_path, 'rev.txt')}"
end
