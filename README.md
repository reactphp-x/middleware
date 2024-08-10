# reactphp-x-middleware

## install

```
composer require reactphp-x/middleware -vvv
```

## usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$http = new React\Http\HttpServer(
    new ReactphpX\Middleware\FiberHandler,
    new ReactphpX\Middleware\TrustedProxyMiddleware,
    new ReactphpX\Middleware\CorsMiddleware,
    function (Psr\Http\Message\ServerRequestInterface $request) {
        return React\Http\Message\Response::plaintext(
            "Hello World!\n"
        );
    }
);

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$http->listen($socket);
```

or 

```php

<?php

require __DIR__ . '/vendor/autoload.php';

$http = new React\Http\HttpServer(
    new MiddlewareHandler([
        new ReactphpX\Middleware\FiberHandler,
        new ReactphpX\Middleware\TrustedProxyMiddleware,
        new ReactphpX\Middleware\CorsMiddleware,
        function (Psr\Http\Message\ServerRequestInterface $request) {
            return React\Http\Message\Response::plaintext(
                "Hello World!\n"
            );
        }
    ])
);

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$http->listen($socket);

```


## middleware


## License
MIT