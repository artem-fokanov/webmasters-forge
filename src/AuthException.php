<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 13.04.2017
 * Time: 20:53
 */

namespace src;


class AuthException extends \Exception {

    const USER_DOESNT_EXIST = 0;
    const USER_WITH_SUCH_LOGIN_EXIST = 1;

    public function __construct($message = "", $code = 0, $previous = null)
    {
        switch ($code) {
            case self::USER_DOESNT_EXIST:
                $message = 'Incorrect username or password';
                break;
            case self::USER_WITH_SUCH_LOGIN_EXIST:
                $message = 'User with such login is already exists';
                break;
            default: break;
        }

        http_response_code(401);
        parent::__construct($message, $code, $previous);
    }
}