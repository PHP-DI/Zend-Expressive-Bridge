<?php
declare(strict_types = 1);

return array(
    \Zend\Expressive\Container\WhoopsErrorHandlerFactory::class => \DI\object()->lazy(),
    \Zend\Expressive\Container\WhoopsFactory::class => \DI\object()->lazy(),
    \Zend\Expressive\Container\WhoopsPageHandlerFactory::class => \DI\object()->lazy(),
    'Zend\Expressive\Whoops' => \DI\factory(\Zend\Expressive\Container\WhoopsFactory::class),
    'Zend\Expressive\WhoopsPageHandler' => \DI\factory(\Zend\Expressive\Container\WhoopsPageHandlerFactory::class),
    'Zend\Expressive\FinalHandler' => \DI\factory(\Zend\Expressive\Container\WhoopsErrorHandlerFactory::class),
    //'Zend\Expressive\FinalHandler' => \DI\factory(\Zend\Expressive\Container\TemplatedErrorHandlerFactory::class), //In production
);