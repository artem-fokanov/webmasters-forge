<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 12.04.2017
 * Time: 6:02
 */

namespace src;


final class User extends AbstractModel {

    protected $id;
    protected $nickname;
    protected $password_hash;
    protected $registered;

    public static function newFromArray(array $user)
    {
        $model = parent::newFromArray($user);
        foreach ($user as $property => $value) {
            if ($model->validate($property, $value) !== false)
                $model->cast($property, $value);
        }
        return $model;
    }

    protected function validate($property, $value)
    {
        switch ($property) {
            case 'id':
            case 'registered':
                return filter_var($value, FILTER_VALIDATE_INT);
            case 'password_hash':
                return strlen($value) == 60;
            default:
                return true;
        }
    }

    protected function cast($property, $value)
    {
        switch ($property) {
            case 'nickname':
                $value = filter_var($value, FILTER_SANITIZE_STRING);
                break;
            default:
                break;
        }

        $this->$property = $value;
    }
}