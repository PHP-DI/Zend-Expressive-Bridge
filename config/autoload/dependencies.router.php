<?php
declare(strict_types = 1);

if(class_exists('Zend\Expressive\Router\AuraRouter')){
    return array(
        \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\AuraRouter::class),
        \Zend\Expressive\Router\AuraRouter::class => \DI\object(),
    );
}
if(class_exists('Zend\Expressive\Router\FastRouteRouter')){
    return array(
        \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\FastRouteRouter::class),
        \Zend\Expressive\Router\FastRouteRouter::class => \DI\object(),
    );
}
if(class_exists('Zend\Expressive\Router\ZendRouter')){
    return array(
        \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\ZendRouter::class),
        \Zend\Expressive\Router\ZendRouter::class => \DI\object(),
    );
}
throw new RuntimeException('No Router available to use in Dependency Injection Container');
