## install

1. cp .env.example .env
2. docker-compose up -d
3. docker exec -it php-74 bash
4. composer install
5. connect DB with env
6. php artisan key:generate
7. php artisan migrate

# configuration permission

1. chmod -R 777 storage
2. chmod -R 775 bootstrap/cache

## install node_modules

1. yarn or npm install
2. yarn watch or npm run watch

## open web

**http://localhost:8089/**
