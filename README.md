# Introduction

SIS written on Lumen Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

# Installation

```
# configure your .env
git clone git@github.com:bernardpeh/sis.git

# remember create sis db first

# setup
cd sis
cp .env .env.example
php artisan migrate
php artisan db:seed

# start web server
cd public
php -S localhost:8080
```

# Unit Testing

```
# test file
vendor/bin/phpunit --filter UserTest

# test individual test
vendor/bin/phpunit --filter testShouldReturnSingleUser
```

## Lumen Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).


