<?php

namespace src;


class Auth {

    protected $_started = false;
    protected $_isAuth = false;

    public function __construct() {
        $this->auth();
    }

    public function unAuth() {
        $this->_destroySession();
    }

    public function auth() {
        if(isset($_COOKIE[session_name()])) {
            $this->_startSession();
            $this->_isAuth = true;
        }
    }

    protected function _startSession() {
        if (!$this->_started) {
            session_start();
            $this->_started = true;
        }
    }

    protected function _destroySession() {
        if ($this->_started) {
            session_unset();
            session_destroy();
            $this->_started = false;
        }
    }

    public function isAuthentificated() {
        return $this->_isAuth;
    }

}