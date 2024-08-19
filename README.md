# The App

This application if formed of two separate applications, one for the backend and one for the frontend applications,
each in their own separate git repository. You will need to clone both repository and checkout to the correct
branch before doing anything else.

To keep the two repository separate let's create a new directory where we can clone them both.
```shell
mkdir ~/giulio-test
```

## The frontend

```shell
cd ~/giulio-test
git clone git@github.com:stefan-kcl/Giulio-task.git frontend
cd frontend
git checkout test-solution
```

This app is written in Next.js, so you will need to use `yarn` to run it.
```shell
yarn dev
```

## The backend

```shell
cd ~/giulio-test
git clone git@github.com:troccoli/kcl-task.git backend
cd backend
git checkout test-solution
```

### Requirements
The backend for this application has been built with PHP and the Laravel framework.

You will need:

- PHP 8.3
- Composer 2.7
- SQLite

### Setting up the application

Let's start by installing all the dependencies.
```shell
cd ~/giulio-task/backend
composer install
```

A Laravel application is configured by environment variables, which are set in a `.env` file.
The application provides an example of this file, and all you need to do is generate the application key and create
an empty database.

```shell
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

Before starting the application, you will need to create the necessary tables and data.
```shell
php artisan migrate --seed
```

Now we are ready to start the application

```shell
php artisan serve --port=8000
```

## Testing the application

Open your browser and go to `http://127.0.0.1:3000`. 

To test the login functionality, a user has already been created for your:
- username: `test@example.com`
- password: `password`
