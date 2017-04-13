<?php

namespace src;

class Auth {

    /**
     * @var bool - флаг создания сессии
     */
    protected $_started = false;

    /**
     * @var bool - флаг авторизованного пользователя
     */
    protected $_isAuth = false;

    /**
     * @var \src\User - модель пользователя
     */
    public $user;

    public function __construct(User &$user) {
        $this->user = $user;
        $this->auth();
    }

    /**
     * авторизация
     */
    public function auth() {

        // возобновление ранее начатой сессии
        if(isset($_COOKIE[session_name()])) {
            $this->_startSession();

            $this->user = $_SESSION['user'];

            $this->_isAuth = true;
            return;
        }

        // создание новой сессии при наличии логин-пароля
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

    /**
     * деавторизация
     */
    public function unAuth() {
        $this->_destroySession();
        $this->_isAuth = false;
        // перенаправление на "главную"
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