# rstgroup/statsd-module [![Build Status](https://travis-ci.org/rstgroup/statsd-module.svg?branch=master)](https://travis-ci.org/rstgroup/statsd-module)

Module is based on [domnikl/statsd-php](https://github.com/domnikl/statsd-php).


## Installation

Update your composer.json with following lines:

```javascript
"require": {
    "rstgroup/statsd-module": "^1.0"
}
```


## Configuration

In your ZF2 application config add to module list

```php
return [
    'modules' => [
        'RstGroup\\StatsdModule',
    ],
];
```

also in your autoload config based on enviroment add statsd client configuration

```php
return [
    'statsd' => [
        'tcp' => [
            'host' => 'example_host',
            'port' => example_port,
            'timeout' => null,
            'persistent' => false,
            'mtu' => 1500,
        ],
        'udp' => [
            'host' => 'example_host',
            'port' => example_port,
            'timeout' => null,
            'persistent' => false,
            'mtu' => 1500,
        ],
        'namespace' => 'services.default',
        'connectionType' => 'RstGroup\Statsd\Connection\Blackhole',
    ],
];
```

Connection types:

* `RstGroup\Statsd\Connection\Udp`
* `RstGroup\Statsd\Connection\Tcp` errors will not be suppressed in this mode
* `RstGroup\Statsd\Connection\Memory` in this mode sending is disabled, but messages are collected
* `RstGroup\Statsd\Connection\Blackhole` in this mode sending is disabled




## Usage

Typical usage from ServiceManager

```php
$client = $serviceManager->get("RstGroup\Statsd\Client");
```
