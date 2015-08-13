<?php

namespace BitSensor\Handler;


use BitSensor\Core\CodeError;
use BitSensor\Core\Collector;

/**
 * Handler to run when an error in the application occurs. Collects data about
 * @package BitSensor\Handler
 */
class CodeErrorHandler {

    /**
     * @param int $errno Error code.
     * @param string $errstr Error description.
     * @param string $errfile Name of the file in which the error occurred.
     * @param int $errline Line at which the error occurred.
     * @param array $errcontext Stacktrace of the error.
     */
    public static function handle($errno, $errstr, $errfile, $errline, $errcontext) {
        /**
         * @global Collector $bitSensor
         */
        global $bitSensor;

        $bitSensor->addError(new CodeError($errno, $errstr, $errfile, $errline));
    }

}