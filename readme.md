# Quincalla

Quincalla is a minimal e-commerce site build with Laravel 5.2

## Installation

- Clone repository
- Run composer
```
composer install
```
- Migrations
```
php artisan migrate
```
- Seeds
```
php artisan db:seed
```
- Frontend
```
npm install yarn gulp -g
yarn install
gulp
```

## Testing

- Unit
```
vendor/bin/phpspec run
```
- Functional
```
vendor/bin/phpunit
```
- Acceptance
```
vendor/bin/behat
```

