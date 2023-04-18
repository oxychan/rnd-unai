## How to setup

### Clone project

`git clone https://github.com/oxychan/rnd-unair.git`

### Navigate to the project directory

`cd ./rnd-unair`

### Install all dependencies

`composer install`

### Configure the .env file

`cp .env.example .env`

### Generate a key

`php artisan key:generate`

### Run the migration

`php artisan migrate:fresh --seed`

### Launch the App

`php artisan serve`
