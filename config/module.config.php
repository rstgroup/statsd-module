<?php

return [
    'service_manager' => [
        'factories' => [
            \Domnikl\Statsd\Client::class => \RstGroup\StatsdModule\ClientFactory::class,
            \Domnikl\Statsd\Connection\UdpSocket::class => \RstGroup\StatsdModule\Connection\UdpFactory::class,
            \Domnikl\Statsd\Connection\TcpSocket::class => \RstGroup\StatsdModule\Connection\TcpFactory::class,
            \Domnikl\Statsd\Connection\Blackhole::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Domnikl\Statsd\Connection\InMemory::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
        'aliases' => [
            'statsd' => \Domnikl\Statsd\Client::class,
            'RstGroup\Statsd\Client' => \Domnikl\Statsd\Client::class,
            'RstGroup\Statsd\Connection\Udp' => \Domnikl\Statsd\Connection\UdpSocket::class,
            'RstGroup\Statsd\Connection\Tcp' => \Domnikl\Statsd\Connection\TcpSocket::class,
            'RstGroup\Statsd\Connection\Blackhole' => \Domnikl\Statsd\Connection\Blackhole::class,
            'RstGroup\Statsd\Connection\Memory' => \Domnikl\Statsd\Connection\InMemory::class,
        ],
    ],
    // Statsd client module start configuration
    'statsd' => [
        'tcp' => [
            'host' => 'localhost',
            'port' => 8125,
            'timeout' => null,
            'persistent' => false,
            'mtu' => 1500,
        ],
        'udp' => [
            'host' => 'localhost',
            'port' => 8125,
            'timeout' => null,
            'persistent' => false,
            'mtu' => 1500,
        ],
        'namespace' => 'services.default',
        'connectionType' => \Domnikl\Statsd\Connection\Blackhole::class, // service name from container
    ],
];
