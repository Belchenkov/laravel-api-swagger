init: docker-down docker-build docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker-compose exec backend vendor/bin/phpunit

queue:
	docker-compose exec backend php artisan queue:work

db-migrate:
	docker-compose exec backend php artisan migrate

db-seed:
	docker-compose exec backend php artisan db:seed

db-migrate-seed:
	docker-compose exec backend php artisan migrate --seed

db-refresh:
	docker-compose exec backend php artisan migrate:refresh --seed

passport-install:
	docker-compose exec backend php artisan passport:install

docs:
	docker-compose exec backend php artisan l5-swagger:generate

generate-token:
	docker-compose exec backend php artisan token:generate 1
