

download project

migrate

php bin/console doctrine:database:create
symfony console doctrine:migrations:migrate


load fixtures for default data

generate password for user symfony console security:hash-password

create record in database

```sql
INSERT INTO admin (username, roles, password) VALUES ('admin', '[\"ROLE_ADMIN\"]', 'hashed_password')
```