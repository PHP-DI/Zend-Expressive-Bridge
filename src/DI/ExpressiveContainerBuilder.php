<?php
declare(strict_types=1);

namespace DI;

class ExpressiveContainerBuilder extends ContainerBuilder
{

    /**
     * @param bool   $inProduction
     * @param string $containerClass
     */
    public function __construct($inProduction = false, $containerClass = 'DI\Container')
    {
        parent::__construct($containerClass);

        $this->registerDependencies();
        $this->registerErrorHandler($inProduction);
        $this->registerMiddlewarePipeline();
    }

    private function registerDependencies()
    {
        $this->addDefinitions([
            \Interop\Container\ContainerInterface::class => function (\Interop\Container\ContainerInterface $container) {
                return $container;
            },
            \Zend\Expressive\Application::class => \DI\factory(\Zend\Expressive\Container\ApplicationFactory::class),
            \Zend\Expressive\Container\ApplicationFactory::class => \DI\object(),
            \Zend\Expressive\Helper\ServerUrlHelper::class => \DI\object(),
            \Zend\Expressive\Helper\UrlHelper::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperFactory::class),
        ]);
    }

    private function registerErrorHandler($inProduction)
    {
        $this->addDefinitions([
            \Zend\Expressive\Container\WhoopsErrorHandlerFactory::class => \DI\object()->lazy(),
            \Zend\Expressive\Container\WhoopsFactory::class => \DI\object()->lazy(),
            \Zend\Expressive\Container\WhoopsPageHandlerFactory::class => \DI\object()->lazy(),
            'Zend\Expressive\Whoops' => \DI\factory(\Zend\Expressive\Container\WhoopsFactory::class),
            'Zend\Expressive\WhoopsPageHandler' => \DI\factory(\Zend\Expressive\Container\WhoopsPageHandlerFactory::class),
            'Zend\Expressive\FinalHandler' => $inProduction ? \DI\factory(\Zend\Expressive\Container\TemplatedErrorHandlerFactory::class) : \DI\factory(\Zend\Expressive\Container\WhoopsErrorHandlerFactory::class),
        ]);
    }

    public function registerAuraRouter()
    {
        $this->addDefinitions([
            \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\AuraRouter::class),
            \Zend\Expressive\Router\AuraRouter::class => \DI\object(),
        ]);
    }

    public function registerFastRouteRouter()
    {
        $this->addDefinitions([
            \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\FastRouteRouter::class),
            \Zend\Expressive\Router\FastRouteRouter::class => \DI\object(),
        ]);
    }

    public function registerZendRouter()
    {
        $this->addDefinitions([
            \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\ZendRouter::class),
            \Zend\Expressive\Router\ZendRouter::class => \DI\object(),
        ]);
    }

    public function registerPlatesRenderer()
    {
        $this->addDefinitions([
            \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\Plates\PlatesRendererFactory::class),
        ]);
    }

    public function registerTwigRenderer()
    {
        $this->addDefinitions([
            \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\Twig\TwigRendererFactory::class),
        ]);
    }

    /**
     * Note that ZendViewRendererFactory::injectHelpers() seems to use an incorrect 'default' HelperPluginManager resulting in:
     * Deprecated: Zend\ServiceManager\AbstractPluginManager::__construct now expects a Interop\Container\ContainerInterface instance representing the parent container; please update your code in
     *
     * @see \Zend\Expressive\ZendView\ZendViewRendererFactory::injectHelpers()
     */
    public function registerZendViewRenderer()
    {
        $this->addDefinitions([
            \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\ZendView\ZendViewRendererFactory::class),
            \Zend\View\HelperPluginManager::class => \DI\factory(\Zend\Expressive\ZendView\HelperPluginManagerFactory::class),
        ]);
    }

    private function registerMiddlewarePipeline()
    {
        $this->addDefinitions([
            \Zend\Expressive\Helper\ServerUrlMiddleware::class => \DI\factory(\Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class),
            \Zend\Expressive\Helper\UrlHelperMiddleware::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class),
        ]);
    }
}
