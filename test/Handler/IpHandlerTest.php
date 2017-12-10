<?php

namespace BitSensor\Test\Handler;


use BitSensor\Core\Config;
use BitSensor\Core\Context;
use BitSensor\Core\IpContext;
use BitSensor\Handler\IpHandler;

class IpHandlerTest extends HandlerTest
{

    public function setUp()
    {
        parent::setUp();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $_SERVER['HTTP_X_FORWARDED_FOR'] = '127.0.0.2, 8.8.8.8';
    }

    public function tearDown()
    {
        parent::tearDown();

        unset(
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_X_FORWARDED_FOR']
        );
    }

    public function testHandle()
    {
        $handler = new IpHandler();
        $handler->handle($this->datapoint, new Config());

        $context = $this->datapoint->getContext();
        self::assertEquals('127.0.0.1', $context['ip']);
    }

    public function testHandleForwarded()
    {
        $config = new Config();
        $config->setIpAddressSrc(Config::IP_ADDRESS_X_FORWARDED_FOR);

        $handler = new IpHandler();
        $handler->handle($this->datapoint, $config);

        $context = $this->datapoint->getContext();
        self::assertEquals('127.0.0.2', $context['ip']);
    }

    public function testHandleManual()
    {
        $config = new Config();
        $config->setIpAddressSrc(Config::IP_ADDRESS_MANUAL);
        $config->setIpAddress('127.0.0.3');

        $handler = new IpHandler();
        $handler->handle($this->datapoint, $config);

        $context = $this->datapoint->getContext();
        self::assertEquals('127.0.0.3', $context['ip']);
    }
}
