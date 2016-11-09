<?php

namespace RstGroup\StatsdModule\Connection;

use Domnikl\Statsd\Connection\UdpSocket;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory that creates UDP connection type
 */
class UdpFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, UdpSocket::class);
    }

    /**
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
        $config = $container->get('Config')['statsd']['udp'];

        return new UdpSocket(
            $config['host'],
            $config['port'],
            $config['timeout'],
            $config['persistent'],
            $config['mtu']
        );
    }
}
