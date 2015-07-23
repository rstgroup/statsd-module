<?php

namespace RstGroup\StatsdModule;

use Domnikl\Statsd\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory that creates Statsd client
 */
class ClientFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config')['statsd'];
        $connection = $serviceLocator->get($config['connectionType']);

        return new Client($connection, $config['namespace']);
    }
}
