AD Company ERP System

Setup & RUN

Note: if database exists, please drop it first by executing below command.

      php bin/console doctrine:database:drop --force 
   
1) php bin/console doctrine:database:create

2) php bin/console doctrine:migrations:execute --up 20191129232050

3) php bin/console doctrine:fixtures:load

4) manually modify DATABASE_URL in the .env file.
 
5) symfony server:start

6) Login as: 

   Username: 'Test1', Password: '123456' // HR/Director authorization

   Username: 'Test2', Password: '123456' // No HR/Director authorization

