NGINX_CONTAINER = "symfony6-nginx"
PHP_CONTAINER = "symfony6-php"
DOCKER_COMPOSE = docker-compose
PROJECT = "Symfony6"

.PHONY: container-up container-stop

# Docker

# Start the containers and build them every time this commands is called
container-up:
	@echo "Docker container building and starting ..."
	$(DOCKER_COMPOSE) up --build -d

# This will stop all containers services
container-stop:
	@echo "\nStopping docker container"
	$(DOCKER_COMPOSE) stop
