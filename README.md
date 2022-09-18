## How to install

First copy .env.example and paste with .env name.
then edit .env file and put your database config in it.
and in the end just run following commands:

- `composer install`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan serve`

now you can see website in your browser with this url
`http://localhost:8000`