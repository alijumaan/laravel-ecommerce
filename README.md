# Laravel E-commerce 

## installation :
after install the source code open Terminal to use these command line:
- composer install ( may need to use "composer update")
- cp .env.example .env 
- create new database (RECOMMENDED: DB = "laravel_ecommerce")
- php artisan key:generate
- php artisan storage:link
- php artisan migrate --seed
- npm install
- npm run dev
- Use your mail configuration in .env to avoid "Connection could not be established with host mailhog :stream_socket_client()" 
- php artisan serve or your_domain.test
- mkdir storage/app/public/images
- mkdir storage/app/public/images/categories
- mkdir storage/app/public/images/products
- mkdir storage/app/public/images/users
- if you want to use pusher and redis check the Documentation (Optional)

## Permission folder ( Linux | Mac)
- sudo chmod -R 777 settings.json
- sudo chmod -R 777 storage
- sudo chmod -R 777 bootstrap/cache

## Try
<a href='https://cartwhite.tk' target="_blank">https://cartwhite.tk</a>

## Contact me
<a href='https://alijumaan.com' target="_blank">https://alijumaan.com</a>

