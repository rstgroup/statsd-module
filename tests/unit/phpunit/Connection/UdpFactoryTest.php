<?php

namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\UdpFactory;

use Domnikl\Statsd\Connection\UdpSocket;
use Interop\Container\ContainerInterface;
use RstGroup\StatsdModule\Connection\UdpFactory;

class UdpFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing proper building udp connection
     */
    public function testWillReturnProperlyConfiguredUdpConnectorForStatsdClient()
    {
        $config = [
            'statsd' => [
                'udp'            => [
                    'host'       => 'localhost',
                    'port'       => 8125,
                    'timeout'    => null,
                    'persistent' => false,
                    'mtu'        => 1500,
                ],
            ],
        ];

        $factory = new UdpFactory();

        $containerMock = $this->getMock(ContainerInterface::class);

        $containerMock->expects($this->once())
                           ->method('get')
                           ->with($this->equalTo('Config'))
                           ->will($this->returnValue($config));

        $connection = $factory($containerMock);
        $this->assertInstanceOf(UdpSocket::class, $connection);
        $this->assertEquals($connection->getHost(), $config['statsd']['udp']['host']);
        $this->assertEquals($connection->getPort(), $config['statsd']['udp']['port']);
        $this->assertEquals($connection->getTimeout(), $config['statsd']['udp']['timeout']);
    }
}
