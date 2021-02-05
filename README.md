# identibyte-laravel
This is a wrapper for the [Identibyte](https://identibyte.com/) API. Iddentibyte allows you to identify and mark disposable email addresses to save your company's resources for real users.

## Installation
* Get an api key from [here](https://identibyte.com/)
* Run `composer require adenijiayocharles/identibyte-laravel` from your Laravel application root. 
* Add the below to the bottom of your `.env`
```php
IDENTIBYTE_KEY={your-api-key}
```
* Publish the config file from the package by running
```bash
php artisan vendor:publish --provider="Adenijiayocharles\Identibyte\IdentibyteServiceProvider"
```

## Usage
