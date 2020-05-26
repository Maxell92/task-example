# task-example

This is an example application for task management.

## Requirements:

* PHP 7.3
* Database

## Setup

* `composer install`
* Create `env.local` with your database credentials
* Run migration: `php bin/console d:m:m`

## Tests

* `php bin/phpunit`
* `vendor/bin/phpstan analyse`
* `vendor/bin/ecs check`

## Known issues:

* Functional tests need to clear database before run.
* Function is very limited to show work with Symfony 5 and run basic unit and functional test.
* Not all functionality is covered by tests - for example screen with closed tasks, filter for tasks for today etc.
* No edit / delete for tasks.
