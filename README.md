## Blog

React + Laravel + SQLite

###### Instructions for building / running the application:

Run the following commands to install and build the application:

```shell script
composer install

php artisan migrate --seed

npm install

npm run prod
```

The application will be ready after the completion of migrations to the database with the generation of demo data, the 
react application will be compiled for production. Upon completion of scripts with initialization, installation of 
dependencies, etc. run command:

```shell script
php artisan serve
```

By default, the application will run on:
http://127.0.0.1:8000

If you want to launch the application with a different IP and PORT, before launching, you will need to change the value 
of the MIX_API_URL parameter in the .env file and rebuild the react application part.

Functionality:
* Navigation forward / backward
* view article
* adding a new article

