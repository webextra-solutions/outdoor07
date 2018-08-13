DB_NAME = 'ExtranetFFH'.freeze
URL = 'extranet-cake2.outdoor07.lvh.me'.freeze

SHELL = '/bin/bash'.freeze
COMPOSER = 'docker-compose run --rm composer'.freeze

desc 'mysql:console', 'Lance la console mysql'
DB_EXEC = 'docker exec -i $(docker-compose ps -q db | sed -n 1p) /bin/bash -c '.freeze
shell_task 'mysql:console', "#{DB_EXEC} 'mysql -uroot -proot #{DB_NAME}'"

desc 'docker:run', 'Lance docker-compose up'
shell_task 'docker:run', 'docker-compose up -d web db mail phpmyadmin'

desc 'docker:restart', 'Lance docker-compose restart'
shell_task 'docker:restart', 'docker-compose restart'

desc 'composer', 'Lance composer'
shell_task 'composer', COMPOSER

desc 'docker:install', 'Installe le docker-compose.yml'
task 'docker:install' do
  if File.exist?('.c42/docker-compose.yml') && File.exist?('docker-compose.yml')
    info('docker-compose.yml is already present')
  else
    info('copying docker-compose.yml')
    copy_file('docker-compose.yml.dist', '.c42/docker-compose.yml')
    create_link('docker-compose.yml', '.c42/docker-compose.yml')
    unless ENV['SKIP_QUESTIONS']
      if yes?('Do you want to edit docker-compose.yml? [y/N]')
        system(%("${EDITOR:-vim}" docker-compose.yml ))
      end
    end
  end
end

desc 'install', 'Installe le projet'
task :install do


  info('docker:install')
  invoke 'docker:install',[]

  # info('copy create Cake App.php')
  # copy_file('../config/app.default.php','./config/app.php')

  info('docker:run')
  invoke 'docker:run',[]

  info('composer:install')
  invoke 'composer',['install --ignore-platform-reqs']
end

desc 'deploy:install', 'Installe le projet lors du déploiement'
task 'deploy:install' do
  info('docker:install')
  invoke 'docker:install',[]

  info('composer:install')
  invoke 'composer',['install --ignore-platform-reqs']

  info('composer:dumpautoload')
  invoke 'composer',['dumpautoload -o']
end

depenvs = %w[preprod production]
desc 'deploy DEPLOY_ENV', "deploy to DEPLOY_ENV (#{depenvs.join(', ')})"
task :deploy do |dep_env = 'preprod'|
  unless depenvs.include?(dep_env)
    error("environnement inconnu: #{dep_env}")
    error('')
    error('DEPLOY_ENV:')
    depenvs.each do |e|
      error("\t- #{e}")
    end
    error('')
    fatal('Impossible de continuer')
  end

  # exec remplace le process actuel
  exec({
         'SKIP_QUESTIONS' => '1'
       }, %(bundle exec cap #{dep_env} deploy))
end


depenvs = %w[preprod production]
desc 'deploy DEPLOY_ENV', "deploy to DEPLOY_ENV (#{depenvs.join(', ')})"
task "deploy:setup" do |dep_env = 'preprod'|
  unless depenvs.include?(dep_env)
    error("environnement inconnu: #{dep_env}")
    error('')
    error('DEPLOY_ENV:')
    depenvs.each do |e|
      error("\t- #{e}")
    end
    error('')
    fatal('Impossible de continuer')
  end

  # exec remplace le process actuel
  exec({
         'SKIP_QUESTIONS' => '1'
       }, %(bundle exec cap #{dep_env} deploy:setup))
end
