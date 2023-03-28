
The Frontend you can find in 

[Frontend](https://github.com/mateussiil/buzzvel-2023-dev-team-test-frontend)


## Step by step to run the project

Clone Repository
```sh
git clone https://github.com/mateussiil/buzz-2023-dev-team-test-backend.git app-backend
```

```sh
cd app-backend/
```


Create the .env file
```sh
cp .env.example .env
```


Update .env file environment variables
```
APP_NAME=buzz-backend
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user_name
DB_PASSWORD=db_password

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Upload the project containers
```sh
docker-compose up -d
```


Access the container
```sh
docker-compose exec app bash
```


Install project dependencies
```sh
composer install
```


Generate Laravel project key
```sh
php artisan key:generate
```

generate migrates
```sh
php artisan migrate
```

run test
```sh
php artisan test
```


Acess the project
[http://localhost:8989](http://localhost:8989)


