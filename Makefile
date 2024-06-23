ENV_FILE=.env

include $(ENV_FILE)

long-wait:
	@echo "Take a long sleep... 20 sec"
	@sleep 20

short-wait:
	@echo "Take a short sleep... 5 sec"
	@sleep 5

image:
	@echo "Building docker image..."
	@docker-compose build

up:
	@echo "Uping all containers..."
	docker-compose up -d

down:
	@echo "Downing all containers..."
	docker-compose down

down-v:
	@echo "Downing all containers and volumes..."
	docker-compose down -v

up-necessary:
	@echo "Uping necessary containers..."
	docker-compose up -d simply-pay-redis simply-pay-php simply-pay-db simply-pay-nginx

app-key:
	@if [ -z "$(APP_KEY)" ]; then \
		echo "Generating app key..."; \
		docker container exec -ti simply-pay-php php artisan key:generate; \
	fi

cache:
	@echo "Caching application..."
	@docker container exec -ti simply-pay-php php artisan optimize && \
	docker container exec -ti simply-pay-php php artisan view:cache && \
	docker container exec -ti simply-pay-php php artisan event:cache && \
	docker container exec -ti simply-pay-php php artisan package:discover && \
	docker container exec -ti simply-pay-php php artisan auth:clear-resets

queue-listen:
	@echo "Starting listener"
	@docker container exec -ti simply-pay-php php artisan queue:listen

queue-work:
	@echo "Starting worker"
	@docker container exec -ti simply-pay-php php artisan queue:work redis --tries=10

php-stan:
	@echo "analyzing the code"
	@docker container exec -ti simply-pay-php vendor/bin/phpstan analyse app tests

test:
	@echo "Running Tests..."
	@docker container exec -ti simply-pay-php php artisan test

migrate:
	@echo "Migrating database..."
	@docker container exec -ti -ti simply-pay-php php artisan migrate

seed:
	@echo "Seeding database..."
	@docker container exec -ti simply-pay-php php artisan db:seed

passport:
	@echo "Passport install..."
	@docker container exec -ti simply-pay-php php artisan passport:install

install:
	@echo "Installing dependencies with composer..."
	@docker container exec -ti simply-pay-php composer install
	@rm -rf .composer

deploy: codebase-pull image image-push

dev: image up-necessary short-wait install app-key long-wait migrate seed short-wait passport
