<?php

/**
 * Kernel
 * php version 7.6
 *
 * @category Api
 * @package  Symphony_Api
 * @author   User <user@log.pt>
 * @license  MIT License (c) copyright 2011-2013 original author or authors
 * @link     https://github.com/falcon758/symphony_api
 */

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

/**
 * Class Kernel
 * php version 7.6
 *
 * @category Api
 * @package  Symphony_Api
 * @author   User <user@log.pt>
 * @license  MIT License (c) copyright 2011-2013 original author or authors
 * @link     https://github.com/falcon758/symphony_api
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * Configure container
     * 
     * @param ContainerConfiguration $container Container configuration
     * 
     * @return void
     */
    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    /**
     * Configure routes
     * 
     * @param RoutingConfigurator $routes Routing configuration
     * 
     * @return void
     */
    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
