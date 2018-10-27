<?php
declare(strict_types=1);

namespace DI;

class ExpressiveContainerBuilder extends ContainerBuilder
{
    public function __construct(bool $inProduction = false, string $containerClass = 'DI\Container')
    {
        parent::__construct($containerClass);

        $this->registerDependencies();
        $this->registerErrorHandler($inProduction);
        $this->registerMiddlewarePipeline();
    }

    private function registerDependencies(): void
    {
        $this->addDefinitions([
            \Interop\Container\ContainerInterface::class => function (\Interop\Container\ContainerInterface $container) {
                return $container;
            },
            \Zend\Expressive\Application::class => \DI\factory(\Zend\Expressive\Container\ApplicationFactory::class),
            \Zend\Expressive\Container\ApplicationFactory::class => \DI\autowire(),
            \Zend\Expressive\Helper\ServerUrlHelper::class => \DI\autowire(),
            \Zend\Expressive\Helper\UrlHelper::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperFactory::class),
        ]);
    }

    private function registerErrorHandler(bool $inProduction): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Container\WhoopsErrorHandlerFactory::class => \DI\autowire()->lazy(),
            \Zend\Expressive\Container\WhoopsFactory::class => \DI\autowire()->lazy(),
            \Zend\Expressive\Container\WhoopsPageHandlerFactory::class => \DI\autowire()->lazy(),
            'Zend\Expressive\Whoops' => \DI\factory(\Zend\Expressive\Container\WhoopsFactory::class),
            'Zend\Expressive\WhoopsPageHandler' => \DI\factory(\Zend\Expressive\Container\WhoopsPageHandlerFactory::class),
            'Zend\Expressive\FinalHandler' => $inProduction ? \DI\factory(\Zend\Expressive\Container\TemplatedErrorHandlerFactory::class) : \DI\factory(\Zend\Expressive\Container\WhoopsErrorHandlerFactory::class),
        ]);
    }

    public function registerAuraRouter(): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\AuraRouter::class),
            \Zend\Expressive\Router\AuraRouter::class => \DI\autowire(),
        ]);
    }

    public function registerFastRouteRouter(): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\FastRouteRouter::class),
            \Zend\Expressive\Router\FastRouteRouter::class => \DI\autowire(),
        ]);
    }

    public function registerZendRouter(): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Router\RouterInterface::class => \DI\get(\Zend\Expressive\Router\ZendRouter::class),
            \Zend\Expressive\Router\ZendRouter::class => \DI\autowire(),
        ]);
    }

    public function registerPlatesRenderer(): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\Plates\PlatesRendererFactory::class),
        ]);
    }

    public function registerTwigRenderer(): void
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
    public function registerZendViewRenderer(): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Template\TemplateRendererInterface::class => \DI\factory(\Zend\Expressive\ZendView\ZendViewRendererFactory::class),
            \Zend\View\HelperPluginManager::class => \DI\factory(\Zend\Expressive\ZendView\HelperPluginManagerFactory::class),
        ]);
    }

    private function registerMiddlewarePipeline(): void
    {
        $this->addDefinitions([
            \Zend\Expressive\Helper\ServerUrlMiddleware::class => \DI\factory(\Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class),
            \Zend\Expressive\Helper\UrlHelperMiddleware::class => \DI\factory(\Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class),
        ]);
    }
}
