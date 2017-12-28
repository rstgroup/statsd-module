<?php

namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\TcpFactory;

use Domnikl\Statsd\Connection\TcpSocket;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use RstGroup\StatsdModule\Connection\TcpFactory;

class TcpFactoryTest extends TestCase
{
    /**
     * Testing proper building tcp connection
     */
    public function testWillReturnProperlyConfiguredTcpConnectorForStatsdClient()
    {
        $config = [
            'statsd' => [
                'tcp'            => [
                    'host'       => 'localhost',
                    'port'       => 8125,
                    'timeout'    => null,
                    'persistent' => false,
                    'mtu'        => 1500,
                ],
            ],
        ];

        $factory = new TcpFactory();

        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->method('get')
                ->with($this->equalTo('Config'))
                ->will($this->returnValue($config));

        $connection = $factory($containerMock);
        $this->assertInstanceOf(TcpSocket::class, $connection);
        $this->assertEquals($connection->getHost(), $config['statsd']['tcp']['host']);
        $this->assertEquals($connection->getPort(), $config['statsd']['tcp']['port']);
        $this->assertEquals($connection->getTimeout(), $config['statsd']['tcp']['timeout']);
    }
}
