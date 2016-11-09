<?php

namespace RstGroup\StatsdModule\Connection;

use Domnikl\Statsd\Connection\UdpSocket;
use Interop\Container\ContainerInterface;

/**
 * Factory that creates UDP connection type
 */
class UdpFactory
{
    public function __invoke(ContainerInterface $container)
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
