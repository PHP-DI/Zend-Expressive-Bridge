# Zend-Expressive-Bridge

The easiest way to use PHP-DI with Zend Expressive, seems to:
 
 - assemble the Dependency Injection Container using some default definition files
 - use the DIC to get the Zend Expressive Application
 - run the Application

Index.php

```php

<?php

// Delegate static file requests back to the PHP built-in WebServer
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

require __DIR__ . '/../vendor/autoload.php';

/** @var \DI\ContainerBuilder $containerBuilder */
$containerBuilder = require __DIR__ . '/../vendor/php-di/zend-expressive-bridge/config/containerBuilder.php';
$inProduction = false; //You probably want to use an environment variable for this...
$containerBuilder->writeProxiesToFile($inProduction, __DIR__ . '/../data/cache'); //You probably want to use caching in production

//Add your own application-specific Dependency Definitions to the Container Builder
$pathToDependencyDefinitions = __DIR__ . '/../config/dependencies/{{,*.}global,{,*.}local}.php';
$phpFileProvider = new \Zend\Expressive\ConfigManager\PhpFileProvider($pathToDependencyDefinitions);
$dependencyDefinitions = $phpFileProvider();
foreach ($dependencyDefinitions as $definitions) {
    $containerBuilder->addDefinitions($definitions);
}

$container = $containerBuilder->build();

//Assign configuration to container
$config = require __DIR__ . '/../config.php';
$container->set('config', $config);

/** @var \Zend\Expressive\Application $app */
$app = $container->get(\Zend\Expressive\Application::class);
$app->run();

```
