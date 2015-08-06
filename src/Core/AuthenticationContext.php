<?php

namespace BitSensor\Core;


class AuthenticationContext extends Context {

    const PHP_AUTH_USER = 'username';
    const PHP_AUTH_PW = 'password';
    const AUTH_TYPE = 'type';

    public function __construct() {
        $this->setName(Context::AUTH);
        $this->setValue(array(
            self::PHP_AUTH_USER => $_SERVER['PHP_AUTH_USER'],
            self::PHP_AUTH_PW => $_SERVER['PHP_AUTH_PW'],
            self::AUTH_TYPE => $_SERVER['AUTH_TYPE']
        ));
    }


}