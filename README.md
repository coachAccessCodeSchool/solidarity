# Solidarity
Every time you start a project you have to configure the tools before you can start. And we lose time.

Configured to use Symfony 4 or higher
PHP 7.4
Redis cache system 
MySql database 
Nginx Web Server 

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