help:## show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.PHONY: docker-build
docker-build:## build docker local images
	docker compose build --no-cache

.PHONY: up
up:## spin up docker environment
	docker compose up -d

.PHONY: down
down:## stop docker environment
	docker compose stop

.PHONY: reset-db
reset-db:## recreate the database schema and load the fixtures
	docker compose exec php php /var/www/html/public/bin/reset_db.php
	docker compose exec php php /var/www/html/public/bin/setup_db.php
	docker compose exec php php /var/www/html/public/bin/load_fixtures.php

.PHONY: cli
cli:## enter docker environment
	docker compose exec -ti php /bin/bash
