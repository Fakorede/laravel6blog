<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Setup Application

1. Create a `.env` file and copy everything in the `.env.example` over.

2. Run `php artisan key:generate` to create a new `APP_KEY` in the `.env` file.

3. Run `composer install` to create the vendor folder and import all packages.

4. Configure the Database settings in the `.env` file to connect to MySQL.

```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

5. Create the database in MySQL and use `php artisan migrate` to run the migrations.

6. Create a redis database on [Redis Labs](redislabs.coms) and copy the endpoint and password in your configuration and add it to the Redis config in the `.env` file.

```
REDIS_HOST={your-endpoint}
REDIS_PASSWORD={your-password}
REDIS_CACHE_DB=0
```

Also, don't forget to set the cache driver:

```
CACHE DRIVER=redis
```

7. Start app with `php artisan serve`.

8. Run the tests with the `./vendor/bin/phpunit` command.

9. Run `php artisan db:seed` to generate some fake data.
