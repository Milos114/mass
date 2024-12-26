
## Setup

- git clone
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

The easiest way to set up the queue is to set database connection in .env: QUEUE_CONNECTION=database
