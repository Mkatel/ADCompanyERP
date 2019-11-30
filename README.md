AD Company ERP System

Setup & RUN

Note: if database exists, please drop it first by executing below command.
      php bin/console doctrine:database:drop --force 
   
1) php bin/console doctrine:database:create

2) php bin/console doctrine:migrations:execute --up 20191129232050

3) php bin/console doctrine:fixtures:load

4) symfony server:start

5) Login: 

   Username: 'Test1', Password: '123456' // user this test HR/Director authorization
   
   Username: 'Test2', Password: '123456' // other users

