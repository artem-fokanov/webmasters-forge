<?php

namespace src;

class Auth {

    protected $_started = false;
    protected $_isAuth = false;
    protected $_user;

    public function __construct(User $user = null) {
        if (!is_null($user)) {
            $this->_user = $user;
        }
        $this->auth();
    }

    public function unAuth() {
        $this->_destroySession();
    }

    public function auth() {
        if(isset($_COOKIE[session_name()])) {
            $this->_startSession();
            $this->_isAuth = true;
            return;
        }

        if (isset($_POST['nickname'], $_POST['password'])) {
            $userData = $this->_user->getByNickname($_POST['nickname']);

            if (password_verify($_POST['password'], $userData['password_hash'])) {
                $this->_startSession();
                $this->_isAuth = true;
                return;
            }
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
            unset($_COOKIE[session_name()]);
            $this->_started = false;
            $this->_isAuth = false;
        }
    }

    public function isAuthentificated() {
        return $this->_isAuth;
    }

}