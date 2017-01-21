<?php
declare(strict_types = 1);

if(class_exists('Zend\Expressive\Plates\PlatesRendererFactory')){
    return array(
        \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\Plates\PlatesRendererFactory::class),
    );
}
if(class_exists('Zend\Expressive\Twig\TwigRendererFactory')){
    return array(
        \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\Twig\TwigRendererFactory::class),
    );
}
if(class_exists('Zend\Expressive\ZendView\ZendViewRendererFactory')){
    return array(
        \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\ZendView\ZendViewRendererFactory::class),
        /**
         * injectHelpers() seems to use an incorrect 'default' HelperPluginManager resulting in:
         * Deprecated: Zend\ServiceManager\AbstractPluginManager::__construct now expects a Interop\Container\ContainerInterface instance representing the parent container; please update your code in
         *
         * @see \Zend\Expressive\ZendView\ZendViewRendererFactory::injectHelpers()
         */
        \Zend\View\HelperPluginManager::class => \DI\factory(\Zend\Expressive\ZendView\HelperPluginManagerFactory::class),
    );
}

return array(); //Template engine is not mandatory
