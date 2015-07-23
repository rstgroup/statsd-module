<?php

namespace RstGroup\StatsdModule\Connection;

use Domnikl\Statsd\Connection\TcpSocket;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory that creates TCP connection type
 */
class TcpFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config')['statsd']['tcp'];

        return new TcpSocket(
            $config['host'],
            $config['port'],
            $config['timeout'],
            $config['persistent'],
            $config['mtu']
        );
    }
}
