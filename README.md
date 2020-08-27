## Application structure

#### app/Console -> run some php commands via Symfony Console
#### app/Dto -> use a dto to map external resources
#### app/Events -> create events for the app
#### app/Exceptions -> handle exceptions of the application
#### app/Http -> perform the request + validate the request via Controllers
#### app/Models -> metadefinition of the tables + relationship between them
#### app/Providers
#### app/Services
#### app/Repository -> perform query to the database
#### app/ThirdParty -> store data from external sources
#### database -> migration, seeds, factories for unit tests
#### public -> index.php front controller of the app
#### routes -> public and api routes(need authentication)
#### tests -> perform integration tests for app
#### rest-api-doc -> postman collection

#### This is a MVC project structure

#### Installation

1. Clone this repository
1. Run composer install
1. Create and fill the .env file (example included /.env-example)
1. Run following commands:  
    `` php artisan cache:clear`` \
    `` php artisan migrate:refresh`` \
    `` php -S localhost:8000 -t public``

1. You can do some optimization in the future if you want to run the script more than once
1. Checking the lastUpdated key from film entity. You will import/edit films base of the lastUpdated changes
