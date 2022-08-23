## Watchcrunch
## Implemented features
* [x] Get the users with the number of posts and the title of the last post, who have created more than 10 posts in the last 7 days.
* [x] Create schedule command to check the weekly active users.
* [x] Write unit tests for the most active users query

## Result
the screen below describes the number of executed queries and the memory usage as well as the execution time, after running the query that get the most active users, against more 10.000 users and each one has between 4 and 15 posts
![](docs/debug.png)

## Used technologies
- PHP 7.4
- Laravel 8
- PHPUnit
- Docker

## Installation Steps

> prerequisite: PHP > 7.4

* Clone repository
* `composer install`
* Create DB eg: `watchcrunch`
* `composer setup` (copies `env` file, generates key, and migrates DB)
* Configure your phpunit.xml file
* Then run ``` php artisan test ```
