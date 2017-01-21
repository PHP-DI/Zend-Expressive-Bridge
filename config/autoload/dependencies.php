<?php
declare(strict_types = 1);

return array(
    \Interop\Container\ContainerInterface::class => function (\Interop\Container\ContainerInterface $container) {
        return $container;
    },
    \Zend\Expressive\Application::class => \DI\factory(\Zend\Expressive\Container\ApplicationFactory::class),
    \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\FastRouteRouter::class),
    \Zend\Expressive\Router\FastRouteRouter::class => \DI\object(),
    \Zend\Expressive\Container\ApplicationFactory::class => \DI\object(),
    /**
     * injectHelpers() seems to use an incorrect 'default' HelperPluginManager resulting in:
     * Deprecated: Zend\ServiceManager\AbstractPluginManager::__construct now expects a Interop\Container\ContainerInterface instance representing the parent container; please update your code in
     *
     * @see \Zend\Expressive\ZendView\ZendViewRendererFactory::injectHelpers()
     */
    \Zend\View\HelperPluginManager::class => \DI\factory(\Zend\Expressive\ZendView\HelperPluginManagerFactory::class),
    \Zend\Expressive\Helper\ServerUrlHelper::class => \DI\object(),
    \Zend\Expressive\Helper\UrlHelper::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperFactory::class),
);