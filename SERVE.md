Local serve

This project provides a simple Artisan `serve` command that starts PHP's built-in webserver. Use:

```
php artisan serve --host=127.0.0.1 --port=8000
```

If you prefer to run the server manually you can use PHP directly from the project root:

```
php -S 127.0.0.1:8000 -t public
```
