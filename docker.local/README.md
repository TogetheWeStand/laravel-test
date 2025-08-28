 ## usage
 ## Старые инструкции, требуют актуализации! ИСПОЛЬЗОВАТЬ НА СВОЙ СТРАХ И РИСК!
1. `cd docker`
2. `cp .env.example .env`
3. `docker-compose up -d --build`
4. `docker-compose exec php-fpm sh -c "composer install"` *optional* if you have no composer on host machine
