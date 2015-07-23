<?php

namespace RstGroup\StatsdModule\Connection;

use Domnikl\Statsd\Connection\UdpSocket;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory that creates UDP connection type
 */
class UdpFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config')['statsd']['udp'];

        return new UdpSocket(
            $config['host'],
            $config['port'],
            $config['timeout'],
            $config['persistent'],
            $config['mtu']
        );
    }
}
