<?php

namespace src;

class Auth {

    protected $_started = false;
    protected $_isAuth = false;
    public $user;

    public function __construct(User &$user) {
        $this->user = $user;
        $this->auth();
    }

    public function auth() {

        if(isset($_COOKIE[session_name()])) {
            $this->_startSession();

            $this->user = $_SESSION['user'];

            $this->_isAuth = true;
            return;
        }

        if (isset($_POST['nickname'], $_POST['password'])) {

            $userData = $this->user->getByNickname($_POST['nickname']);

            if ($userData && password_verify($_POST['password'], $userData['password_hash'])) {
                $this->_startSession();

                $_SESSION['user'] = $this->user;

                $this->_isAuth = true;
                return;
            }
        }
    }

    public function unAuth() {
        $this->_destroySession();
        $this->_isAuth = false;
        header('Location: /');
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
            setcookie(session_name(), '', 1);
//            unset($_COOKIE[session_name()]);
            $this->_started = false;
        }
    }

    public function isAuthentificated() {
        return $this->_isAuth;
    }

}

class AuthException extends \Exception {

    const USER_DOESNT_EXIST = 0;

    public function __construct($message = "", $code = 0, $previous = null)
    {
        switch ($code) {
            case self::USER_DOESNT_EXIST:
                $message = 'User doesn\'t exist.';
        }
        parent::__construct($message, $code, $previous);
    }
}