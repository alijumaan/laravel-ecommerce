# Laravel E-commerce 

## installation :
after install the source code open Terminal to use these command line:
- composer install ( may need to use "composer update").
- cp .env.example .env 
- create new database.
- php artisan key:generate.
- php artisan storage:link.
- if you need countries, states, cities data (change database in public/ecommerce_world.sql line 22)
- php artisan migrate --seed
- npm install.
- npm run dev.
- Use your mail configuration in .env 
- php artisan serve or your_domain.test
- mkdir storage/app/public/images.
- mkdir storage/app/public/images/categories.
- mkdir storage/app/public/images/products.
- mkdir storage/app/public/images/users.
- if you want to use pusher and redis check the Documentation.

## Permission folder ( Linux | Mac)
- sudo chmod -R 777 settings.json
- sudo chmod -R 777 storage
- sudo chmod -R 777 bootstrap/cache

## Demo
<a href='http://demoshop.alialqahtani.sa' target="_blank">Try</a>

