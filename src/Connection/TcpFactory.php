<?php

namespace RstGroup\StatsdModule\Connection;

use Domnikl\Statsd\Connection\TcpSocket;
use Interop\Container\ContainerInterface;

/**
 * Factory that creates TCP connection type
 */
class TcpFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config')['statsd']['tcp'];

        return new TcpSocket(
            $config['host'],
            $config['port'],
            $config['timeout'],
            $config['persistent'],
            $config['mtu']
        );
    }
}
