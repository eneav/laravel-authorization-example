# Implementation of roles and permissions in laravel 7

Example of implementation of roles and permissions in laravel using the [ laravel-authorization](https://github.com/eneav/laravel-authorization) package

## Installation
1\. Clone the repository
``` bash
 git clone https://github.com/eneav/laravel-authorization-example.git
```
2\. Install dependencies
``` bash
 cd laravel-authorization-example
 composer install
```

_If the .env file is not generated, it must be generated_
``` bash
 cp .env.example .env
 php artisan key:generate
```

3\. Create a database
``` mysql
mysql> create database authorization_example;
```
4\. Configure database credentials
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=authorization_example 
DB_USERNAME=root
DB_PASSWORD=
```
5\. execute the migrations and seeders
``` bash
 php artisan migrate --seed
```
6\. Turn on the server
``` bash
 php artisan serve
```

## Users

Username	      | Password | Permissions      | Roles
------------------|----------|------------------|------------
hello@enea.io     | nano     | *                | Admin
editor@enea.io    | nano     | mofidy-articles  |
creator@enea.io   | nano     | create-articles  |
destroyer@enea.io | nano     | destroy-articles |
