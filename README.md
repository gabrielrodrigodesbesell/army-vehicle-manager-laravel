## Deployment

- Extract the archive and put it in the folder you want
- Run cp **.env.example** **.env** file to copy example file to **.env**
- Then edit your **.env** file with DB credentials and other settings.
- Run **composer require jenssegers/agent** command
- Run **composer require werneckbh/laravel-qr-code** command
- Run **composer install** command
- Run **php artisan migrate --seed** command.
- Notice: seed is important, because it will create the first admin user for you.
- Run **php artisan key:generate** command.
- Run **php artisan storage:link** command. 

#### Default credentials
Username: **admin@admin.com**
Password: **password**

#### Additional steps:
- remove permission 'cadastrador_soldados' from admin profile 
- remove permission 'cadastro_pessoa_sem_login' from admin profile. Add this permission only for users who will not fill in login and password data.
- Verify SOLDADO_ROLE_ID in .env file
- Verify SECAO_SAIDAQUARTEL_ID in .env file
- Verify upload max file size on server in php.ini
### Author
Gabriel Rodrigo Desbesell

### License
Right of use granted by the author to Brazilian army - 14 RCMec of São Miguel do Oeste - SC - Brazil.