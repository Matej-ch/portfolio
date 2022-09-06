download project git clone https://github.com/Matej-ch/portfolio.git

### Features

### Requirements

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