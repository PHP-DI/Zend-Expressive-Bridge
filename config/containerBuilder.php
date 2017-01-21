<?php
declare(strict_types=1);

return (new \DI\ContainerBuilder())
    ->addDefinitions(__DIR__ . '/autoload/dependencies.php')
    ->addDefinitions(__DIR__ . '/autoload/dependencies.router.php')
    ->addDefinitions(__DIR__ . '/autoload/dependencies.templating.php')
    ->addDefinitions(__DIR__ . '/autoload/errorHandler.php')
    ->addDefinitions(__DIR__ . '/autoload/middleware-pipeline.php');
