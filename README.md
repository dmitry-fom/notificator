By default 

Queue driver=redis
Mail Driver=log

The only mail will be logged, any other services should be customized by .env.

## First Setup

copy .env.example:

`> cp app/.env.example app/.env`

Build and up docker containers:

`> docker compose build`

Up app container & setup composer dependencies

`> docker compose up -d app`

`> docker compose exec app sh -c "composer install && php artisan migrate"`

## Usage

Run the rest of services

`> docker compose up -d`

You can use ./publish sh to publish message to the queue

`> ./app/publish [:channel] [:type] [:text]`

ex. 

`> ./app/publish mail birthday 'Best wishes!'`

or command from app container:

`> php artisan notification:push mail birthday "Best wishes!`

All notifications processed via they own queue, errors and notification statuses logging to default laravel.log file.