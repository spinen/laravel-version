# SPINEN's Laravel Version

[![Latest Stable Version](https://poser.pugx.org/spinen/laravel-version/v/stable)](https://packagist.org/packages/spinen/laravel-version)
[![Total Downloads](https://poser.pugx.org/spinen/laravel-version/downloads)](https://packagist.org/packages/spinen/laravel-version)
[![Latest Unstable Version](https://poser.pugx.org/spinen/laravel-version/v/unstable)](https://packagist.org/packages/spinen/laravel-version)
[![License](https://poser.pugx.org/spinen/laravel-version/license)](https://packagist.org/packages/spinen/laravel-version)

The soft deletes are great in Laravel to make sure that some deleted data can be recovered. This package allows you to configure an array of models with how many days that you want the soft deleted data to stay in the database.

## Build Status

| Branch | Status | Coverage | Code Quality |
| ------ | :----: | :------: | :----------: |
| Develop | [![Build Status](https://travis-ci.org/spinen/laravel-version.svg?branch=develop)](https://travis-ci.org/spinen/laravel-version) | [![Code Coverage](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=develop) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=develop) |
| Master | [![Build Status](https://travis-ci.org/spinen/laravel-version.svg?branch=master)](https://travis-ci.org/spinen/laravel-version) | [![Code Coverage](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=develop) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=master) |

## Prerequisite

As side from Laravel >= 5.5, there are X packages that are required

* [something/something](https://somewhere)

## Install

Install Version:

```bash
    $ composer require spinen/laravel-version
```

The package uses the auto registration feature

## Using the package

Something here...

## Configuration

Publish the package config file to `config/version.php`:

```bash
    $ php artisan vendor:publish
```

This file is fully documented.  You will need to make the changes to that file to suit your needs. There are X main configuration items...

1. One
2. Two
