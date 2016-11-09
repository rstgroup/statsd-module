<?php

namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\UdpFactory;

use Domnikl\Statsd\Connection\UdpSocket;
use RstGroup\StatsdModule\Connection\UdpFactory;
use Zend\ServiceManager\ServiceManager;

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

        $serviceLocatorMock = $this->getMock(ServiceManager::class, array('get'));

        $serviceLocatorMock->expects($this->once())
                           ->method('get')
                           ->with($this->equalTo('Config'))
                           ->will($this->returnValue($config));

        $connection = $factory->createService($serviceLocatorMock);
        $this->assertInstanceOf(UdpSocket::class, $connection);
        $this->assertEquals($connection->getHost(), $config['statsd']['udp']['host']);
        $this->assertEquals($connection->getPort(), $config['statsd']['udp']['port']);
        $this->assertEquals($connection->getTimeout(), $config['statsd']['udp']['timeout']);
    }
}
