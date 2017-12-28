<?php

namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\ClientFactory;

use Domnikl\Statsd\Client;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use RstGroup\StatsdModule\ClientFactory;

class ClientFactoryTest extends TestCase
{
    /**
     * Testing proper building statsd client
     *
     * @dataProvider connectionProvider
     * @param array $config
     */
    public function testWillReturnProperStatsdClientInstance(array $config)
    {
        $factory = new ClientFactory();

        $containerMock = $this->createMock(ContainerInterface::class);

        $connectionMock = $this->getMockBuilder($config['realConnection'])
            ->disableOriginalConstructor()
            ->getMock();

        $serviceLocatorServices = [
            'Config' => $config,
            $config['statsd']['connectionType'] => $connectionMock,
        ];

        $containerMock
            ->method('get')
            ->will($this->returnCallback(function($name) use ($serviceLocatorServices) {
                return $serviceLocatorServices[$name];
            }));

        $this->assertInstanceOf(Client::class, $factory($containerMock));
    }

    public function connectionProvider()
    {
        return [
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Blackhole',
                    ],
                    'realConnection' => \Domnikl\Statsd\Connection\Blackhole::class,
                ],
            ],
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Tcp',
                    ],
                    'realConnection' => \Domnikl\Statsd\Connection\TcpSocket::class,
                ],
            ],
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Udp',
                    ],
                    'realConnection' => \Domnikl\Statsd\Connection\UdpSocket::class,
                ],
            ],
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Memory',
                    ],
                    'realConnection' => \Domnikl\Statsd\Connection\InMemory::class,
                ],
            ],
        ];
    }
}
