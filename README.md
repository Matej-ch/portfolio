

download project git clone https://github.com/Matej-ch/portfolio.git

migrate

php bin/console doctrine:database:create
symfony console doctrine:migrations:migrate


load fixtures for default data

generate password for user symfony console security:hash-password

create default records in database (by default data will be purged)

default user will be admin with password admin12345

symfony console doctrine:fixtures:load --group=live