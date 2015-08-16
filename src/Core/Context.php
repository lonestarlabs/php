<?php

namespace BitSensor\Core;


/**
 * Container for information that helps to authenticate a user.
 * @package BitSensor\Core
 */
abstract class Context {

    /**
     * IP address of the connecting user.
     */
    const REMOTE_ADDR = 'ip';
    /**
     * HTTP request.
     */
    const HTTP = 'http';
    /**
     * Authentication of the connecting user.
     */
    const AUTH = 'authentication';
    /**
     * Server information.
     */
    const ENDPOINT = 'enpoint';
    /**
     * POST, GET and Cookie.
     */
    const INPUT = 'input';
    /**
     * ModSecurity.
     */
    const MOD_SECURITY = 'modSecurity';

    /**
     * Name of the context.
     *
     * @var string
     */
    private $name;
    /**
     * Content of the context. May be a string or an array.
     *
     * @var array|string
     */
    private $value;

    /**
     * @return string Name of the context.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name Name of the context.
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return array|string Content of the context.
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param array|string $value Context of the context.
     */
    public function setValue($value) {
        $this->value = $value;
    }

}