<?php

namespace RstGroup\StatsdModule\Tests\Unit\PHPUnit\ClientFactory;

use RstGroup\StatsdModule\ClientFactory;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Testing proper building statsd client
     *
     * @dataProvider connectionProvider
     */
    public function testCreateClient(array $config)
    {
        $factory = new ClientFactory();

        $serviceLocatorMock = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')
                ->setMethods(array('get'))
                ->disableOriginalConstructor()
                ->getMock();

        $connectionMock = $this->getMockBuilder($config['realConnection'])
                ->disableOriginalConstructor()
                ->getMock();


        $serviceLocatorMock->expects($this->at(0))
                ->method('get')
                ->with($this->equalTo('Config'))
                ->will($this->returnValue($config));

        $serviceLocatorMock->expects($this->at(1))
                ->method('get')
                ->with($this->equalTo($config['statsd']['connectionType']))
                ->will($this->returnValue($connectionMock));

        $this->assertInstanceOf('Domnikl\Statsd\Client', $factory->createService($serviceLocatorMock));
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
                    'realConnection' => 'Domnikl\Statsd\Connection\Blackhole',
                ],
            ],
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Tcp',
                    ],
                    'realConnection' => 'Domnikl\Statsd\Connection\TcpSocket',
                ],
            ],
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Udp',
                    ],
                    'realConnection' => 'Domnikl\Statsd\Connection\UdpSocket',
                ],
            ],
            [
                [
                    'statsd' => [
                        'namespace' => 'services.default',
                        'connectionType' => 'RstGroup\Statsd\Connection\Memory',
                    ],
                    'realConnection' => 'Domnikl\Statsd\Connection\InMemory',
                ],
            ],
        ];
    }
}