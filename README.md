
# SKELETON
This is a simple PHP project skeleton that uses Docker and Nginx as the web server.

## Requirements
- Docker
- Docker Compose 

## Installation
1. Clone this repository to your local machine
2. Open a terminal and navigate to the root of the project
3. Run the following command to build the Docker images:

```shell
docker-compose build
```
Start the Docker containers:
```shell
docker-compose up -d
```

Connect to the PHP container:

```shell
docker-compose exec php bash
```
Install the project dependencies using Composer:

```shell
composer install
```

## Usage
To access the project, open your web browser and go to http://localhost:8099/hello.

## Troubleshooting
If you encounter any issues with the project, try the following steps:

- Check the Docker logs for any errors:

```shell
docker-compose logs
```