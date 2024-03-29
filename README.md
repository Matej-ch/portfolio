### Example

[Here is my working portfolio page](https://www.matejchalachan.com)

### Requirements

* at least PHP 8.1
    * Apcu enabled, opcache
* Mysql 8 and higher (older version would probably still work)
* composer
* Nodejs (npm)
* server (tested on apache)
    * Redis cache

### Install on server

* Download project ```git clone https://github.com/Matej-ch/portfolio.git```
* Run ```composer install```
* Run ```npm install```
* Run ```npm run build```
* Create database if it doesn't exist ```php bin/console doctrine:database:create```
* Run migrations ```php bin/console doctrine:migrations:migrate```
* Create admin user to login ``php bin/console app:create-admin email username password``
* (_Optional_) Load fixtures with custom data ```php bin/console doctrine:fixtures:load```

* Generate custom password_hash ```php bin/console security:hash-password```
* generate APP_SECRET ```APP_RUNTIME_ENV=prod php bin/console secrets:set APP_SECRET``` and
  add ```APP_SECRET='%env(APP_SECRET)%'``` to ```.env.prod``` file on
  server
* Run ```composer dump-env <enviroment>``` and make sure APP_SECRET is set and not empty

### Features

* List of projects with search
* Detail for project including links to source code and project
* About me page
* Admin functionality
* Connection to GitHub api for readme and other data
* Custom metadata for main page
* Project collections
* Landing page
* Contact me page
* Project image gallery
* Hire me page (on page contact)

#### TODO

1. [ ] Email sending

### Commands

- First create database
  ```php bin/console doctrine:database:create```

- Make entities you require
  ```php bin/console make:entity```

- After entity is set up create migration file
  ``php bin/console make:migration``

- Run migration files and create or update tables
  ```symfony console doctrine:migrations:migrate```

- Load fixtures with default data
  ```symfony console doctrine:fixtures:load```

- Create admin user to login
  ```php bin/console app:create-admin email username password```

generate password for user symfony console security:hash-password

create default records in database (by default data will be purged)

default user will be admin with password tada

symfony console doctrine:fixtures:load --group=live