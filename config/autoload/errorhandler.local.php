<?php
declare(strict_types = 1);

use function DI\object;

return array(
    \Zend\Expressive\Container\WhoopsErrorHandlerFactory::class => object(),
    \Zend\Expressive\Container\WhoopsFactory::class => object(),
    \Zend\Expressive\Container\WhoopsPageHandlerFactory::class => object(),
    \Zend\Expressive\Template\TemplateRendererInterface::class => function (\Interop\Container\ContainerInterface $container) {
        $factory = new \Zend\Expressive\ZendView\ZendViewRendererFactory();
        return $factory($container);
    },
    'Zend\Expressive\Whoops' => function (\Interop\Container\ContainerInterface $container) {
        $factory = $container->get(\Zend\Expressive\Container\WhoopsFactory::class);
        return $factory($container);
    },
    'Zend\Expressive\WhoopsPageHandler' => function (\Interop\Container\ContainerInterface $container) {
        $factory = $container->get(\Zend\Expressive\Container\WhoopsPageHandlerFactory::class);
        return $factory($container);
    },
    'Zend\Expressive\FinalHandler' => function (\Interop\Container\ContainerInterface $container) {
        $factory = $container->get(\Zend\Expressive\Container\WhoopsErrorHandlerFactory::class);
        return $factory($container);
    },
    /* in production
    'Zend\Expressive\FinalHandler' => function (\Interop\Container\ContainerInterface $container) {
        $templatedErrorHandlerFactory = $container->get(\Zend\Expressive\Container\TemplatedErrorHandlerFactory::class);
        return $templatedErrorHandlerFactory($container);
    },
    */
);