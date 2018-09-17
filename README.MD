# Football API

## Project objectives
Create an http API, that allows users to do four things
- get a list of all teams from a league
- create and add a new team to a league
- update a team
- delete a league along with all its teams

## Tech stack
- Symfony
- SQLite
- Doctrine ORM
- PHPUnit

## API documentation
#### Get a list of all teams from a league 
```js
{
    url = "/leagues/{league}/teams",
    method = "GET"
}
```

#### Create and add a new team to a league 
```js
{
    url = "/leagues/{leagueId}/teams",
    method = "POST",
    body = ["id", "name", "strip"]
}
```

#### Update a team from a league (id cannot be updated)
```js
{
    url = "/leagues/{leagueId}/teams/{teamId}",
    method = "PUT",
    body = ["name", "strip"]
}
```

#### Delete a league with all its teams
```js
{
    url = "/leagues/{leagueId}",
    method = "DELETE"
}
```

## Installation 
Make sure you have php 7.2 or higher installed along with sqlite3. Then, run composer to install php dependencies.
```
composer install
```
Run database migration
```
php bin/console doctrine:migrations:migrate
```
Seed the database
```
php bin/console doctrine:fixtures:load
```

## Execute tests
```
vendor/bin/phpunit tests --colors --testdox
```

## Run Symfony server
```
php bin/console server:start
```
