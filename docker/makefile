MAKEFLAGS += --silent

PROJECT_NAME = biteral-sdk-php

DOCKER_NAME = biteral-sdk-php-test

## Docker commands

help: ## Show this help message
	echo 'Docker make'
	echo 'usage: make [command]'
	echo
	echo 'commands:'
	egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

build: ## Builds the environment image
	docker-compose -p ${PROJECT_NAME} --file docker-compose.yml build ${DOCKER_NAME}

ssh: ## SSH into the environment
	docker compose run --rm ${DOCKER_NAME} bash
