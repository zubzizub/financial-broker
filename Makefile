init: docker-down-clear \
	docker-pull docker-build up \
	api-init frontend-init
up: docker-up
down: docker-down
restart: down docker-build up
check: api-lint api-migrations-validate
analyze: api-psalm
docs: api-docs

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

api-init: api-permissions api-composer-install api-migrations api-fixtures

api-permissions:
	docker run --rm -v ${PWD}/api:/app -w /app alpine chmod -R 777 var/cache var/log var/test

api-rules:
	docker run --rm -v ${PWD}/api:/app -w /app alpine chown -R 1000:1000 .

api-composer-install:
	docker-compose run --rm api-php-cli composer install

api-wait-db:
	docker-compose run --rm api-php-cli wait-for-it api-postgres:5432 -t 30

api-migrations:
	docker-compose run --rm api-php-cli composer app migrations:migrate --no-interaction

api-migrations-diff:
	docker-compose run --rm api-php-cli composer app migrations:diff --no-interaction

api-migrations-validate:
	docker-compose run --rm api-php-cli composer app orm:validate-schema

api-lint:
	docker-compose run --rm api-php-cli composer lint
	docker-compose run --rm api-php-cli composer cs-check

api-psalm:
	docker-compose run --rm api-php-cli composer psalm

api-fixtures:
	docker-compose run --rm api-php-cli composer app fixtures:load

api-composer-update:
	docker-compose run --rm api-php-cli composer update

api-docs:
	docker-compose run --rm docs sh /usr/share/nginx/run.sh &

frontend-init: frontend-npm-install frontend-build

frontend-npm-install:
	docker-compose run --rm frontend-nodejs npm install

frontend-build:
	docker-compose run --rm frontend-nodejs npm run build

frontend-watch:
	docker-compose run --rm frontend-nodejs npm run watch

docker-php-in:
	docker-compose exec api-php-fpm sh

docker-nodejs-in:
	docker-compose exec frontend-nodejs bash

build: build-gateway build-frontend build-api

build-gateway:
	docker --log-level=debug build --pull --file=gateway/docker/production/nginx/Dockerfile --tag=${REGISTRY}/broker-gateway:${IMAGE_TAG} gateway/docker

build-frontend:
	docker --log-level=debug build --pull --file=frontend/docker/production/nginx/Dockerfile --tag=${REGISTRY}/broker-frontend:${IMAGE_TAG} frontend

build-api:
	docker --log-level=debug build --pull --file=api/docker/production/php-fpm/Dockerfile --tag=${REGISTRY}/broker-api-php-fpm:${IMAGE_TAG} api
	docker --log-level=debug build --pull --file=api/docker/production/nginx/Dockerfile --tag=${REGISTRY}/broker-api:${IMAGE_TAG} api
	docker --log-level=debug build --pull --file=api/docker/production/php-cli/Dockerfile --tag=${REGISTRY}/broker-api-php-cli:${IMAGE_TAG} api

try-build:
	REGISTRY=localhost IMAGE_TAG=0 make build

push: push-gateway push-frontend push-api

push-gateway:
	docker push ${REGISTRY}/broker-gateway:${IMAGE_TAG}

push-frontend:
	docker push ${REGISTRY}/broker-frontend:${IMAGE_TAG}

push-api:
	docker push ${REGISTRY}/broker-api:${IMAGE_TAG}
	docker push ${REGISTRY}/broker-api-php-fpm:${IMAGE_TAG}
	docker push ${REGISTRY}/broker-api-php-cli:${IMAGE_TAG}

deploy:
	ssh ${HOST} -p ${PORT} 'rm -rf site_${BUILD_NUMBER}'
	ssh ${HOST} -p ${PORT} 'mkdir site_${BUILD_NUMBER}'
	scp -P ${PORT} docker-compose-production.yml ${HOST}:site_${BUILD_NUMBER}/docker-compose-production.yml
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && echo "COMPOSE_PROJECT_NAME=broker" >> .env'
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && echo "REGISTRY=${REGISTRY}" >> .env'
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && echo "IMAGE_TAG=${IMAGE_TAG}" >> .env'
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml pull'
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml up --build --remove-orphans -d'
	ssh ${HOST} -p ${PORT} 'rm -f site'
	ssh ${HOST} -p ${PORT} 'ln -sr site_${BUILD_NUMBER} site'

rollback:
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml pull'
	ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml up --build --remove-orphans -d'
	ssh ${HOST} -p ${PORT} 'rm -f site'
	ssh ${HOST} -p ${PORT} 'ln -sr site_${BUILD_NUMBER} site'
