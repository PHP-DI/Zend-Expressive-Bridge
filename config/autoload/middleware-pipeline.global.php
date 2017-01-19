<?php

declare(strict_types = 1);

return array(
    \Zend\Expressive\Helper\ServerUrlMiddleware::class => \DI\factory(\Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class),
    \Zend\Expressive\Helper\UrlHelperMiddleware::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class),
);