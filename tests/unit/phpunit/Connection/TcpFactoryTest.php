<?php
namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\TcpFactory;

use RstGroup\StatsdModule\Connection\TcpFactory;

class TcpFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing proper building tcp connection
     */
    public function testCreateTcpConnection()
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

        $serviceLocatorMock = $this->getMock('Zend\ServiceManager\ServiceManager', array('get'));
        $serviceLocatorMock->expects($this->once())
                           ->method('get')
                           ->with($this->equalTo('Config'))
                           ->will($this->returnValue($config));

        $connection = $factory->createService($serviceLocatorMock);
        $this->assertInstanceOf('Domnikl\Statsd\Connection\TcpSocket', $connection);
        $this->assertEquals($connection->getHost(), $config['statsd']['tcp']['host']);
        $this->assertEquals($connection->getPort(), $config['statsd']['tcp']['port']);
        $this->assertEquals($connection->getTimeout(), $config['statsd']['tcp']['timeout']);
    }
}
