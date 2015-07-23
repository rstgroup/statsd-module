<?php

return [
    'service_manager' => [
        'factories' => [
            'RstGroup\Statsd\Client' => 'RstGroup\StatsdModule\ClientFactory',
            'RstGroup\Statsd\Connection\Udp' => 'RstGroup\StatsdModule\Connection\UdpFactory',
            'RstGroup\Statsd\Connection\Tcp' => 'RstGroup\StatsdModule\Connection\TcpFactory',
        ],
        'invokables' => [
            'RstGroup\Statsd\Connection\Blackhole' => 'Domnikl\Statsd\Connection\Blackhole',
            'RstGroup\Statsd\Connection\Memory' => 'Domnikl\Statsd\Connection\InMemory',
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
        'connectionType' => 'RstGroup\Statsd\Connection\Blackhole', // service name from service manager
    ],
];
