<?php
declare(strict_types = 1);

//ToDo use PhpFileProvider
$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/autoload/dependencies.global.php');
$containerBuilder->addDefinitions(__DIR__ . '/autoload/errorhandler.local.php');
$containerBuilder->addDefinitions(__DIR__ . '/autoload/middleware-pipeline.global.php');
$this->configureContainer($containerBuilder);

return $containerBuilder->build();
