<?php

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
                return filter_var($value, FILTER_VALIDATE_INT);
            case 'nickname':
                $valid = true;
                if (preg_match('/^[^0-9]\w+$/', $value))
                    $valid = false;

                if (strlen($value) > 0 && strlen($value) <= 30)
                    $valid = false;

                return $valid;
            case 'password_hash':
                return strlen($value) == 60;
            case 'registered':
                return (\DateTime::createFromFormat('Y-m-d H:i:s', $value) !== false);
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

    public function getByNickname(\PDOStatement $statement, $nickname) {

    }
}