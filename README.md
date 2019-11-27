AD Company ERP System

Setup & RUN

1) php bin/console doctrine:database:create

2) php bin/console doctrine:migrations:diff

3) php bin/console doctrine:migrations:migrate

4) php bin/console doctrine:fixtures:load

5) symfony server:start

6) Login: Username: 'Test', Password: '123456'
