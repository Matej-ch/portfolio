### Requirements

* at least PHP 8.1
    * Apcu enabled, opcache
* Mysql 8 and higher (older version would probably still work)
* composer
* Nodejs (npm)
* server (tested on apache)
    * Redis cache

### Install on server

* Download project `git clone https://github.com/Matej-ch/portfolio.git`
* Run `composer install`
* Run `npm install`
* Run `npm run build`
* Create database if it doesn't exist `php bin/console doctrine:database:create`
* Run migrations `php bin/console doctrine:migrations:migrate`
* (_Optional_) Load fixtures with custom data `php bin/console doctrine:fixtures:load`
    * this will generate default admin user with username `admin` password `tada` email `admin@admil.com`
* Generate custom password_hash `php bin/console security:hash-password`
* generate APP_SECRET `APP_RUNTIME_ENV=prod php bin/console secrets:set APP_SECRET` and
  add `APP_SECRET='%env(APP_SECRET)%'` to `.env.prod` file on
  server

### Features

* List of projects with search
* Detail for project including links to source code and project
* About me page
* Admin functionality
* 'Contact me' email sending (WIP)

#### TODO

1. [ ] hire me page
2. [ ] custom metadata for main page
3. [ ] landing page
4. [ ] Connection to GitHub api for readme and other data

### Commands

- First create database
  ``php bin/console doctrine:database:create``

- Make entities you require
  ``php bin/console make:entity``

- After entity is set up create migration file
  ``php bin/console make:migration``

- Run migration files and create or update tables
  ``symfony console doctrine:migrations:migrate``

- Load fixtures with default data
  ``symfony console doctrine:fixtures:load``

generate password for user symfony console security:hash-password

create default records in database (by default data will be purged)

default user will be admin with password tada

symfony console doctrine:fixtures:load --group=live