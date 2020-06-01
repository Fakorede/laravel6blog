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

Also, don't forget to set the cache driver to `redis` or `array` if you won't be using the redis configuration:

```
CACHE_DRIVER=redis
```

7. Configure settings for queues and background processing, you could optionally set it to redis.

```
QUEUE_CONNECTION=database
```

8. Setup Mailtrap

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={your-username}
MAIL_PASSWORD={your-password}
MAIL_ENCRYPTION=null
```

9.  Start app with `php artisan serve`.

10. Run the tests with the `./vendor/bin/phpunit` command.

11. Run `php artisan db:seed` to generate some fake data.

## What I have learnt from this Project

-   Mastered Models, Controllers, Views and all the basics.
-   Solidified knowledge on Database migrations.
-   Database seeding and factories.
-   Local and Global Eloquent Query Scopes
-   Solidified knowledge on PHP Artisan commands.
-   Solidified knowledge on Eloquent Relationships(One to One, One to Many, Many to Many relationships).
-   Learnt Polymorphic Relationships.
-   Blade Components.
-   Authentication Guards.
-   Authorization using Gates and Policies.
-   Caching.
-   Files uploads using the Storage facade.
-   Using Traits in Laravel - SoftDeletes and creating custom ones.
-   Mailable class to send e-mails.
-   Background processing
-   Localization
-   Service, Service Containers, Dependency Injection, Contracts and Facades.
-   Testing in Laravel.
