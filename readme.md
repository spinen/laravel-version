# SPINEN's Laravel Version

[![Latest Stable Version](https://poser.pugx.org/spinen/laravel-version/v/stable)](https://packagist.org/packages/spinen/laravel-version)
[![Total Downloads](https://poser.pugx.org/spinen/laravel-version/downloads)](https://packagist.org/packages/spinen/laravel-version)
[![Latest Unstable Version](https://poser.pugx.org/spinen/laravel-version/v/unstable)](https://packagist.org/packages/spinen/laravel-version)
[![License](https://poser.pugx.org/spinen/laravel-version/license)](https://packagist.org/packages/spinen/laravel-version)

There are many times that it is nice to know the version of your application.  At [Spinen](https://spinen.com), we ad hear to [Semantic Versioning](https://semver.org) for our applications using [git-flow](https://github.com/nvie/gitflow).  We keep a file in the root of our projects named `VERSION` with the current version. The CI/CD process modifies the `VERSION` file to append meaningful data. Then in the views we display the version like this `<meta name="application-version" content="{{ $version }}">`. Additionally, we have a smokescreen test to hit a `/version` route to make sure that the expected version of the site is running.

## Build Status

| Branch | Status | Coverage | Code Quality |
| ------ | :----: | :------: | :----------: |
| Develop | [![Build Status](https://travis-ci.org/spinen/laravel-version.svg?branch=develop)](https://travis-ci.org/spinen/laravel-version) | [![Code Coverage](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=develop) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=develop) |
| Master | [![Build Status](https://travis-ci.org/spinen/laravel-version.svg?branch=master)](https://travis-ci.org/spinen/laravel-version) | [![Code Coverage](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=develop) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spinen/laravel-version/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/spinen/laravel-version/?branch=master) |

## Prerequisite

As side from Laravel >= 5.5, there are no packages that are required

## Install

Install Version:

```bash
$ composer require spinen/laravel-version
```

The package uses the auto registration feature

## Description of version file

You need a file, with your Semantic Version of your application. For example...

```text
4.3.6
```

Then you can add additional data either manually or via your CI/CD pipeline to be similar to this...

```text
4.3.6

feature/some_great_thing
sha:3c40a5b0d0a07973bd117a39b53367c9ff4d4cc0
build:11425
20190220170058+0000
```

Breakdown of the line of the file

| Line | Content | Source | Purpose |
| :----: | ------ | ------ | ------ |
| 1 | 4.3.6 | Original content in the `VERSION` file | Split on `.` to get `major`, `minor`, `patch` |
| 2 | "\n" | (Optional) New line | Readability |
| 3 | feature/some_great_thing | Name of branch | Becomes the `pre_release` |
| 4 | sha:3c40a5b0d0a07973bd117a39b53367c9ff4d4cc0 | Git commit sha | Part of `meta` |
| 5 | build:11425 | Build number | Part of `meta` |
| 6 | 20190220170058+0000 | Datetime stamp of build | Part of `meta` |

Some notes about the file...

* We assume that the first line is only `major`.`minor`.`patch`
* The first non-empty line after the version will become the `pre_release`
* If `pre_release` is `master`, then it gets ignored
* All of the lines after the line being used as the `pre_release` get concatenated together with a `.` to become the `meta`, so there can be as many lines as you would like 

## Using the package

The `Spinen\Version\Version` object loads the configured version file to parse the file into the following public properties on the object...

| Property | Example |
| ------ | ------ |
| semver | 4.3.6-feature/some_great_thing+sha:3c40a5b0d0a07973bd117a39b53367c9ff4d4cc0.build:11425.20190220170058+0000 |
| version | 4.3.6 |
| major | 4 |
| minor | 3 |
| patch | 6 |
| pre_release | feature/some_great_thing |
| meta | sha:3c40a5b0d0a07973bd117a39b53367c9ff4d4cc0.build:11425.20190220170058+0000 |

You can inject `Spinen\Version\Version` into your code to gain access to the properties.  For our use, here are 3 main uses of the package...

1. `$version` variable in views
2. `/version` route
3. `version` commands

#### Variable in views

An instance of `\Spinen\Version\Version` is added to to all views as the `$version` variable. You can do things like...

* Add version to HTML Header
    * `<meta name="application-version" content="{{ $version }}">` to get `<meta name="application-version" content="4.3.6-feature/some_great_thing+sha:3c40a5b0d0a07973bd117a39b53367c9ff4d4cc0.build:11425.20190220170058+0000">`
    * NOTE: Casting object to string is the same as `$version->semver`
* Add version to footer of page
    * `<small class="app_version"">{{ $version->version }}</small>` to get `<small class="app_version"">4.3.6</small>`
   
#### Route

Visiting `/version` will return the version...

```bash
$ curl https://localhost/version
4.3.6-feature/some_great_thing+sha:3c40a5b0d0a07973bd117a39b53367c9ff4d4cc0.build:11425.20190220170058+0000
```

#### Commands

The following `artisan` commands are added...

| Command | Description |
| ------ | ------ |
|  version | Display version of the application. |
|  version:major | Display major version of the application. |
|  version:meta | Display meta version of the application. |
|  version:minor | Display minor version of the application. |
|  version:patch | Display patch version of the application. |
|  version:pre_release | Display pre_release version of the application. |
|  version:semver | Display semver version of the application. |

## Configuration

Publish the package config file to `config/version.php`:

```bash
$ php artisan vendor:publish --tag version-config
```

This file is fully documented.  You will need to make the changes to that file to suit your needs. There are 3 main configuration items...

1. `file` - Name of the file that has the version
2. `route` - Configuration of the route to display the version
3. `view` - Configuration of the view composer to add the version to the views

## Example CI to modify version file

We use [GitLab](https://about.gitlab.com), so here is a partial example `job` that we have in our `.gitlab-ci.yml`...

```yaml
version:
  stage: build

  image: php7.2

  dependencies: []

  script:
    - echo "" >> VERSION
    - echo "${CI_COMMIT_REF_NAME}" >> VERSION
    - echo "sha:${CI_COMMIT_SHA}" >> VERSION
    - echo "build:${CI_PIPELINE_ID}" >> VERSION
    - date +"%Y%m%d%k%M%S%z" >> VERSION

  artifacts:
    name: "${CI_BUILD_NAME}_${CI_BUILD_REF_NAME}-version"
    paths:
      - VERSION
    expire_in: 3 days
```
