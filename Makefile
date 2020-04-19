## Builds the docker container, installs the dependencies
build:
	docker-compose build
	make vendors-install

## Installs the composer dependencies
vendors-install:
	docker-compose run --rm --no-deps php-cli composer install

## Updates composer autoload
dump-autoload:
	docker-compose run  --rm --no-deps php-cli composer dump-autoload

## Runs unit tests
unit-tests:
	docker-compose run  --rm --no-deps php-cli ./vendor/bin/phpunit --no-coverage --stop-on-error --stop-on-failure --testsuite Unit