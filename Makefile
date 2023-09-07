.PHONY: install
install:
	@docker-compose exec app composer install

.PHONY: bash
bash:
	@docker compose exec app /bin/bash

.PHONY: export
export:
	@docker-compose exec app php ./src/bin/export.php $(file)


.PHONY: test
test:
	@docker-compose exec app composer test

.PHONY: test-coverage
test-coverage:
	@docker-compose exec app composer test-coverage

.PHONY: autofix
autofix:
	@docker-compose exec app composer autofix

.PHONY: up
up:
	@docker-compose up -d

.PHONY: stop
stop:
	@docker-compose stop