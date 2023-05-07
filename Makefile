PROJECT_NAME=$(shell basename "$(PWD)")
PROJECT_DIR=$(shell pwd)
DOCKER_COMPOSE=$(shell which docker-compose)
DOCKER=$(shell which docker)

PHP_CONTAINER_NAME=shop
CONTAINER_EXEC=${DOCKER_COMPOSE} exec ${PHP_CONTAINER_NAME}
COMPOSER_EXEC=${CONTAINER_EXEC} composer
CONSOLE_EXEC=${CONTAINER_EXEC} php bin/console

# Colors
G=\033[32m
Y=\033[33m
NC=\033[0m

##
## Help
## ----------------------
help: ## List of all commands
	@grep -E '(^[a-zA-Z_0-9-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) \
	| awk 'BEGIN {FS = ":.*?## "}; {printf "${G}%-24s${NC} %s\n", $$1, $$2}' \
	| sed -e 's/\[32m## /[33m/' && printf "\n"; \
	printf "Project: ${Y}${PROJECT_NAME}${NC}\n"; \
	printf "Project directory: ${Y}${PROJECT_DIR}${NC}\n"; \
	printf "PHP: ${Y}${CONTAINER_EXEC} php${NC}\n"; \
	printf "PHP Composer: ${Y}${COMPOSER_EXEC}${NC}\n\n";

.DEFAULT_GOAL := help
.PHONY: help

##
## Docker commands
## ----------------------
up: ## Up
	${DOCKER_COMPOSE} up -d

down: ## Stop and remove
	${DOCKER_COMPOSE} down

stop: ## stop
	${DOCKER_COMPOSE} stop

restart: down up ## Restart

build: ## Build docker
	${DOCKER_COMPOSE} build

setup: ## Setup (init)
	cp auth.json.dist auth.json
	cp .env.dist .env
	cp .php-cs-fixer.dist.php .php-cs-fixer.php
	cp docker-compose.override.yml.dist docker-compose.override.yml
	make build up ci db-create
	sleep 2
	make mig-apply

sh: ## Enter app container bash
	${CONTAINER_EXEC} sh

logs: ## Show logs
	${DOCKER_COMPOSE} logs --tail 20 -f

ps: ## List running containers
	${DOCKER} ps --format "table {{.ID}}\t{{.Names}}\t{{.Image}}\t{{.Ports}}\t{{.RunningFor}}\t{{.Status}}"

.PHONY: up down restart build setup bash logs ps stop


##
## Database commands
## ----------------------
db-create: ## Create db
	${CONSOLE_EXEC} doctrine:database:create --if-not-exists

db-drop: ## drop db
	${CONSOLE_EXEC} doctrine:database:drop --force

db-recreate: db-drop db-create mig-apply ## Recreate db

mig-diff: ## Run migrations:diff
	${CONSOLE_EXEC} orm:clear-cache:metadata
	${MIGRATIONS_EXEC} doctrine:migrations:diff --formatted
	${CONTAINER_EXEC} chown 1000:1000 -R migrations/

mig-apply: ## Apply migrations
	${CONSOLE_EXEC} doctrine:migrations:migrate --no-interaction

.PHONY: db-create db-recreate mig-diff mig-apply db-drop

##
## Composer commands
## ----------------------
composer-install: ## Install composer dependencies
	${COMPOSER_EXEC} install --no-interaction --prefer-dist --optimize-autoloader

composer-refresh-lock: ## Refresh composer.lock
	${COMPOSER_EXEC} update nothing

composer-validate: ## Analyze composer.json, composer.lock with internal Composer validator
	${COMPOSER_EXEC} validate --no-check-publish

composer-clear-cache: ## Clear composer cache
	${COMPOSER_EXEC} clear-cache

ci: composer-install ## Install composer dependencies (short alias)

crl: composer-refresh-lock ## Refresh composer.lock (short alias)

cv: composer-validate ## Analyze composer.json, composer.lock (short alias)

.PHONY: composer-install composer-refresh-lock composer-validate composer-clear-cache ci crl cv

##
## Code quality commands
## ----------------------
stan: ## Analyze code with phpstan
	${CONTAINER_EXEC} ./vendor/bin/phpstan clear-result-cache
	${CONTAINER_EXEC} ./vendor/bin/phpstan analyse --memory-limit=2G

cs-fix-dry:
	${CONTAINER_EXEC} ./vendor/bin/php-cs-fixer fix src --dry-run --diff

cs-fix:
	${CONTAINER_EXEC} ./vendor/bin/php-cs-fixer fix src --diff

lint: stan cs-fix-dry ## Analyze code with phpstan (alias)

.PHONY: stan lint cs-fix-dry cs-fix
