# News App Laravel Backend

Backend for `news-app-*-frontend`.


## Installation

Follow these steps to get the project up and running on your local machine.


### Prerequisites

- PHP ^8.1
- Composer ^2.0
- SQLite ^3.0 or MySQL ^8.0


### Steps

#### 1. Clone the repository to your local machine:

```shell
git clone https://github.com/antimech/news-app-laravel-backend
```


#### 2. Navigate into the project directory:

```shell
cd news-app-laravel-backend
```


#### 3. Install PHP dependencies using Composer:

```shell
composer install
```


#### 4. Configure database in the `.env` file:

Skip this step if you want to use SQLite. Otherwise, update the configuration accordingly:

```diff
- DB_CONNECTION=sqlite
+ DB_CONNECTION=mysql
- # DB_HOST=127.0.0.1
+ DB_HOST=127.0.0.1
- # DB_PORT=3306
+ DB_PORT=3306
- # DB_DATABASE=news_laravel_backend
+ DB_DATABASE=news_laravel_backend
- # DB_USERNAME=root
+ DB_USERNAME=root
- # DB_PASSWORD=
+ DB_PASSWORD=
```


#### 5. Create a symbolic link from `public/storage` to `storage/app/public`:

```shell
php artisan storage:link
```


#### 6. Run migrations and seeders to set up your database:

```shell
php artisan migrate --seed
```


#### 7. Serve the application:

```shell
php artisan serve
```


#### 8. Access your application at http://localhost:8000 in your web browser.


## Testing

To run the automated tests for this project, execute the following command:

```shell
php artisan test
```

This will run all the tests defined in the tests directory.
