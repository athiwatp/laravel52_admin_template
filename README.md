# laravel52_admin_template
Laravel 5.2, Bootstrap, VueJS, Browserify, Admin Structure

# Prepare the development environment
```shell
# git clone git@github.com:sergey-donchenko/laravel52_admin_template.git ./<YOUR LOCAL FOLDER>/
# cd ./<YOUR LOCAL FOLDER>
# composer install
# npm install
# bower update
```
# Create database (mysql)
```shell
# mysql -u root -p
# mysql> create database laravel5_admin_template;
# mysql> quit;
```

# Create .env and configure the database parameters
```shell
# cp .env.example .env
# nano .env
```

and add there your db settings
```shell
...

DB_HOST=127.0.0.1
DB_DATABASE=laravel5_admin_template
DB_USERNAME=root     
DB_PASSWORD=      

...
```
# Generate a new Application key
```shell
# ./artisan key:generate
Application key [<YOUR LOCAL APPLICATION KEY>] set successfully.
```

# Start the dev environment
```shell
# ./artisan serve --port=8000
Laravel development server started on http://localhost:8000/
```

and now open your browser with the following address: http://localhost:8000/


