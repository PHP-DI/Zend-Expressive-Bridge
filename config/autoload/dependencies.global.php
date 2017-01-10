<?php
declare(strict_types = 1);

use function DI\get;
use function DI\object;

return array(
    \Interop\Container\ContainerInterface::class => function (\Interop\Container\ContainerInterface $container) {
        return $container;
    },
    \Zend\Expressive\Application::class => function (\Interop\Container\ContainerInterface $container) {
        $applicationFactory = $container->get(\Zend\Expressive\Container\ApplicationFactory::class);
        return $applicationFactory($container);
    },
    \Zend\Expressive\Router\RouterInterface::class => get(\Zend\Expressive\Router\FastRouteRouter::class),
    \Zend\Expressive\Router\FastRouteRouter::class => object()->lazy(),
    \Zend\Expressive\Container\ApplicationFactory::class => object()->lazy(),
    /**
     * injectHelpers() seems to use an incorrect 'default' HelperPluginManager resulting in:
     * Deprecated: Zend\ServiceManager\AbstractPluginManager::__construct now expects a Interop\Container\ContainerInterface instance representing the parent container; please update your code in
     *
     * @see \Zend\Expressive\ZendView\ZendViewRendererFactory::injectHelpers()
     */
    \Zend\View\HelperPluginManager::class => function (\Interop\Container\ContainerInterface $container) {
        $factory = new \Zend\Expressive\ZendView\HelperPluginManagerFactory();
        return $factory($container);
    },
    \Zend\Expressive\Helper\ServerUrlHelper::class => object()->lazy(),
    \Zend\Expressive\Helper\UrlHelper::class => function (\Interop\Container\ContainerInterface $container) {
        $factory = new \Zend\Expressive\Helper\UrlHelperFactory();
        return $factory($container);
    },
);