.PHONY: help install api-install admin-install api-serve admin-serve api-console api-about api-test admin-check admin-build check

COMPOSER ?= composer
PHP ?= php
NPM ?= npm

API_DIR := apps/api
ADMIN_DIR := apps/admin

help:
	@echo Available targets:
	@echo "  make install       Install backend and frontend dependencies"
	@echo "  make api-install   Install Symfony dependencies"
	@echo "  make admin-install Install Nuxt dependencies"
	@echo "  make api-serve     Run the Symfony app on http://127.0.0.1:8000"
	@echo "  make admin-serve   Run the Nuxt admin app on http://127.0.0.1:3000"
	@echo "  make api-console   Run Symfony console commands"
	@echo "  make api-about     Show Symfony runtime information"
	@echo "  make api-test      Run backend test suite"
	@echo "  make admin-check   Run frontend type checks"
	@echo "  make admin-build   Build frontend app"
	@echo "  make check         Run backend and frontend validation"

install: api-install admin-install

api-install:
	cd $(API_DIR) && $(COMPOSER) install

admin-install:
	cd $(ADMIN_DIR) && $(NPM) install

api-serve:
	cd $(API_DIR) && $(PHP) -S 127.0.0.1:8000 -t public

admin-serve:
	cd $(ADMIN_DIR) && $(NPM) run dev

api-console:
	cd $(API_DIR) && $(PHP) bin/console

api-about:
	cd $(API_DIR) && $(PHP) bin/console about

api-test:
	cd $(API_DIR) && $(COMPOSER) test

admin-check:
	cd $(ADMIN_DIR) && $(NPM) run check

admin-build:
	cd $(ADMIN_DIR) && $(NPM) run build

check: api-test admin-check admin-build
