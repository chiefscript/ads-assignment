## Introduction

The project is built using Laravel 8. The requirements are:

- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### Setup

- Clone the project
- cd into the project directory
- Run composer update from your terminal
- Run `npm install` to install the required Vue files
- Run cp .env.example .env on Linux or copy .env.example .env on windows
- Create an app key by running php artisan key:generate
- Create a database with a preferred name & update the .env file
- Run `php artisan migrate` on your terminal to create the tables
- Run `php artisan db:seed` to create records on status, countries, offices... tables
- Alternatively, you can use this [database dump](https://drive.google.com/file/d/10zucaBINUylo2Obg5VBJHwO8mjw3Gqfa/view?usp=sharing)
- Run `php artisan serve` to start a development server at `http://localhost:8000:`
- You will need to login using a test user created for the project `email: jdoe@mail.com` `password:qwerty`
- After a successful login, you will be redirected to the projects page


### API
Using a API testing tool such as [Postman](https://postman.com), you can access the endpoints below:
- `127.0.0.1:8000/api/projects/country/Panama`
- `127.0.0.1:8000/api/projects/all`
- `127.0.0.1:8000/api/projects/status/completed`
