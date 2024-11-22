build:
	docker compose up --build -d
	make composer-install
	#make run-migrations
	#make prepare-test-db

start:
	docker compose up -d

stop:
	docker compose stop

down:
	docker compose down --rmi all

composer-install:
	docker exec -i time_tracker_php composer install

run-migrations:
	docker exec -i time_tracker_php php bin/console doctrine:migrations:migrate

prepare-test-db:
	docker exec -i time_tracker_php php bin/console --env=test d:d:d  --force --if-exists
	docker exec -i time_tracker_php php bin/console --env=test d:d:c --if-not-exists
	docker exec -i time_tracker_php php bin/console --env=test d:s:c

run-tests:
	docker exec -i time_tracker_php ./vendor/bin/phpunit
	docker exec -i time_tracker_php ./vendor/bin/behat

ping-mysql:
	@docker exec time_tracker_db mysqladmin --user=root --password=chopin --host "127.0.0.1" ping --silent
