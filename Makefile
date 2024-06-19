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
	docker-compose up -d simply-pay-php simply-pay-db simply-pay-nginx

app-key:
	@if [ -z "$(APP_KEY)" ]; then \
		echo "Generating app key..."; \
		docker container exec -ti simply-pay-php php artisan key:generate; \
	fi

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
