<?php

namespace BitSensor\Test\Core;


use BitSensor\Core\BitSensor;
use BitSensor\Core\Collector;
use BitSensor\Core\Config;
use BitSensor\Core\Context;
use BitSensor\Core\EndpointContext;
use BitSensor\Core\Error;
use BitSensor\Core\InputContext;
use BitSensor\Core\IpContext;

class BitSensorTest extends \PHPUnit_Framework_TestCase {

    public static $proofOfInvocation = false;

    protected function tearDown() {
        restore_error_handler();
        restore_exception_handler();

        global $collector;
        unset($collector);
    }

    public static function tearDownAfterClass() {
        global $bitsensorNoShutdownHandler;
        $bitsensorNoShutdownHandler = true;
    }

    public function testAddContext() {
        $ip = '127.0.0.1';

        $bitSensor = new BitSensor(new Config());
        $bitSensor->addContext(new IpContext($ip));

        /**
         * @global Collector $collector
         */
        global $collector;
        $contexts = $collector->toArray();
	static::assertEquals($ip, $contexts[Context::NAME][IpContext::NAME]);
        static::assertArrayNotHasKey(InputContext::NAME, $contexts);
        static::assertArrayNotHasKey(Error::NAME, $contexts);
    }

    /**
    * @expectedException PHPUnit_Framework_Error
    */
    public function testOldErrorHandlerSet(){
	global $bitSensor;
	$bitSensor = new BitSensor(new Config());
	static::assertEquals('PHPUnit_Util_ErrorHandler', $bitSensor->errorHandler[0]);

    	trigger_error('test');
	static::assertTrue(self::$proofOfInvocation);
	self::$proofOfInvocation = false;
    }

    /**
    * @expectedException PHPUnit_Framework_Error
    */
    public function testOldExceptionHandlerSet(){
        set_exception_handler(array(__CLASS__, 'callback'));
	global $bitSensor;
	$bitSensor = new BitSensor(new Config());
        static::assertEquals(__CLASS__, $bitSensor->exceptionHandler[0]);

	trigger_error('test');
        static::assertTrue(self::$proofOfInvocation);
	self::$proofOfInvocation = false;
    }

    public static function callback($ex){
	BitSensorTest::$proofOfInvocation = true;
    }

    public function testAddEndpointContext() {
        $ip = '127.0.0.1';

        $bitSensor = new BitSensor(new Config());
        $bitSensor->addEndpointContext(new IpContext($ip));

        /**
         * @global Collector $collector
         */
        global $collector;
        $contexts = $collector->toArray();
        static::assertEquals($ip, $contexts[EndpointContext::NAME][IpContext::NAME]);
        static::assertArrayNotHasKey(InputContext::NAME, $contexts);
        static::assertArrayNotHasKey(Error::NAME, $contexts);
    }

    public function testAddError() {
        $message = 'Test Message';
        $code = 17;
        $type = 'Test Type';
        $error = new Error($message, $code, $type);

        $bitSensor = new BitSensor(new Config());
        $bitSensor->addError($error);

        /**
         * @global Collector $collector
         */
        global $collector;
        $contexts = $collector->toArray();
        static::assertArrayHasKey(Error::NAME, $contexts);
        static::assertEquals($error->toArray(), $contexts[Error::NAME][0]);
        static::assertArrayNotHasKey(InputContext::NAME, $contexts);
    }

    public function testAddInput() {
        $ip = '127.0.0.1';

        $bitSensor = new BitSensor(new Config());
        $bitSensor->addInput(new IpContext($ip));

        /**
         * @global Collector $collector
         */
        global $collector;
        $contexts = $collector->toArray();
        static::assertArrayHasKey(InputContext::NAME, $contexts);
        static::assertEquals($ip, $contexts[InputContext::NAME][IpContext::NAME]);
        static::assertArrayNotHasKey(Error::NAME, $contexts);
    }

}