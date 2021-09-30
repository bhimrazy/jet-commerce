cp .env.sqlite .env
php artisan key:generate
php artisan config:cache
touch database/database.sqlite
export DB_CONNECTION=sqlite
php artisan migrate:fresh --seed

