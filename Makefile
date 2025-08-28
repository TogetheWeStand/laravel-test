STARTED_CONTAINERS := $$(docker ps -q)
up:
	if [ -n "$(strip ${STARTED_CONTAINERS})" ]; then \
		docker stop ${STARTED_CONTAINERS}; \
	fi
	docker compose --file docker.local/docker-compose.yml --env-file docker.local/.env up -d --build
down:
	docker compose --file docker.local/docker-compose.yml --env-file docker.local/.env down

init: init-env up init-composer init-migrations-rbac init-migrations-app
init-env:
	if [ ! -f docker.local/.env ] ; then \
		cat docker.local/.env.example > docker.local/.env; \
		echo "\nPOSTGRES_PASSWORD="`openssl rand -base64 12` >> docker.local/.env; \
	fi
init-composer:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "composer install"
init-migrations-rbac:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0"
init-migrations-app:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "php yii migrate --interactive=0"
migrate:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "php artisan migrate"
migrate-create:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "php artisan make:migration $(filter-out $@,$(MAKECMDGOALS))"
migrate-down:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "php artisan migrate:rollback --step=1"
middleware:
	docker compose --file docker.local/docker-compose.yml exec php-fpm /bin/sh -c "php artisan make:middleware $(filter-out $@,$(MAKECMDGOALS))"