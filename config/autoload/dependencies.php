<?php
declare(strict_types = 1);

return array(
    \Interop\Container\ContainerInterface::class => function (\Interop\Container\ContainerInterface $container) {
        return $container;
    },
    \Zend\Expressive\Application::class => \DI\factory(\Zend\Expressive\Container\ApplicationFactory::class),
    \Zend\Expressive\Container\ApplicationFactory::class => \DI\object(),
    \Zend\Expressive\Helper\ServerUrlHelper::class => \DI\object(),
    \Zend\Expressive\Helper\UrlHelper::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperFactory::class),
);