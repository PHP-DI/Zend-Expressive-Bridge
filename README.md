# Zend-Expressive-Bridge

The easiest way to use PHP-DI with Zend Expressive, seems to:
 
 - assemble the Dependency Injection Container using some default definition files
 - use the DIC to get the Zend Expressive Application
 - run the Application

Index.php

```php

<?php

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

require __DIR__ . '/../vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require __DIR__ . '/../vendor/php-di/zend-expressive-bridge/config/container.php';

//Assign configuration to container
$config = require __DIR__ . '/../config.php';
$container->set('config', $config);

/** @var \Zend\Expressive\Application $app */
$app = $container->get(\Zend\Expressive\Application::class);
$app->run();

```
