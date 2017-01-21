<?php
declare(strict_types = 1);

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/autoload/dependencies.php');
$containerBuilder->addDefinitions(__DIR__ . '/autoload/errorHandler.php');
$containerBuilder->addDefinitions(__DIR__ . '/autoload/middleware-pipeline.php');
$this->configureContainer($containerBuilder);

return $containerBuilder->build();
