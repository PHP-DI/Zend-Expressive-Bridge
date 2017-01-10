<?php

declare(strict_types = 1);

return array(
    \Zend\Expressive\Helper\ServerUrlMiddleware::class => function (\Interop\Container\ContainerInterface $container) {
        $factory = new \Zend\Expressive\Helper\ServerUrlMiddlewareFactory();
        return $factory($container);
    },
    \Zend\Expressive\Helper\UrlHelperMiddleware::class => function (\Interop\Container\ContainerInterface $container) {
        $factory = new \Zend\Expressive\Helper\UrlHelperMiddlewareFactory();
        return $factory($container);
    },
);