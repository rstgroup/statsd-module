<?php
namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\UdpFactory;

use RstGroup\StatsdModule\Connection\UdpFactory;

class UdpFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Testing proper building udp connection
     */
    public function testCreateUdpConnection()
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

        $serviceLocatorMock = $this->getMock('Zend\ServiceManager\ServiceManager', array('get'));

        $serviceLocatorMock->expects($this->once())
                           ->method('get')
                           ->with($this->equalTo('Config'))
                           ->will($this->returnValue($config));

        $connection = $factory->createService($serviceLocatorMock);
        $this->assertInstanceOf('Domnikl\Statsd\Connection\UdpSocket', $connection);
        $this->assertEquals($connection->getHost(), $config['statsd']['udp']['host']);
        $this->assertEquals($connection->getPort(), $config['statsd']['udp']['port']);
        $this->assertEquals($connection->getTimeout(), $config['statsd']['udp']['timeout']);
    }
}
