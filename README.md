# Solidarity

Stack:
- Docker
- Symfony 5 (PHP Framework)
- PHP 7.4
- Redis (Cache system)
- MySql 8 (Database)
- Nginx (Web Server)
      

# Install

Requirements: Docker


`git clone https://github.com/coachAccessCodeSchool/solidarity && cd solidarity`

`docker-compose up`

Open other terminal:

`docker-compose exec php bin/bash`

`cd application`

`composer install`

`php bin/console make:migration`

`php bin/console doctrine:migrations:migrate`

Go `http://127.0.0.1:8080`


# Docker
Service|Hostname|Port number
------|---------|-----------
php-fpm|php-fpm|9000
MySQL|mysql|3306
Redis|redis|6379

* Start containers on the foreground: `docker-compose up`. 
* Stop containers: `docker-compose stop`
* Kill containers: `docker-compose kill`
* View container logs: `docker-compose logs`

* Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. 

      * Shell into the PHP container, `docker-compose exec php-fpm bash`
      
      * Run symfony console, `docker-compose exec php-fpm bin/console`
      
      * Open a mysql shell, `docker-compose exec mysql mysql -uroot -p changeme`
      
# Hexagonal architecture

Hexagonal architecture is based on three principles and techniques:

- Explicitly separate User-Side, Business Logic and Server-Side
- Dependencies go to Business Logic
- Borders are isolated by Ports and Adapters


##### User-side (or left side)
This is the side through which the user or external programs will interact with the application. 
Typically, your user interface code, your HTTP routes for an API, your JSON serializations to programs that consume your application are here.

This is the side where you find the actors who drive the Business Logic.

##### Business Logic
This is the part that we want to isolate from what is left and right. 
It contains all the code that implements the business logic. The business logic is what relates to the concrete problem that your application solves.


##### Server-Side
This is where we will find what your application needs, what it drives to work. 
Here you'll find essential infrastructure details such as the code that interacts with your database, 
file system calls, or the code that handles HTTP calls to other applications you depend on, for example.

This is the side where you find the actors that are driven by the Business Logic area.
