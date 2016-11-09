<?php

namespace RstGroup\StatsdModule;

use Domnikl\Statsd\Client;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory that creates Statsd client
 */
class ClientFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, Client::class);
    }

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['statsd'];
        $connection = $container->get($config['connectionType']);

        return new Client($connection, $config['namespace']);
    }
}
