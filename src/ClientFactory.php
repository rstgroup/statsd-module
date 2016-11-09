<?php

namespace RstGroup\StatsdModule;

use Domnikl\Statsd\Client;
use Interop\Container\ContainerInterface;

/**
 * Factory that creates Statsd client
 */
class ClientFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config')['statsd'];
        $connection = $container->get($config['connectionType']);

        return new Client($connection, $config['namespace']);
    }
}
