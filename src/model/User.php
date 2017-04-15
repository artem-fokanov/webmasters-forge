<?php

namespace src\model;
use \src\AbstractModel;
use \src\DbManager;

/**
 * Класс-представление записи в таблице wforge.user
 *
 * Class User
 * @package src
 */
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
                if (!preg_match('/^[^0-9]\w+$/', $value))
                    $valid = false;

                if (!(strlen($value) >= 3 && strlen($value) <= 30))
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
        if (property_exists($this, $property)) {
            switch ($property) {
                case 'id':
                    $value = intval($value);
                    break;
                case 'nickname':
                    $value = filter_var($value, FILTER_SANITIZE_STRING);
                    break;
                default:
                    break;
            }

            $this->$property = $value;
        }
    }

    public function getByNickname() {
        $db = DbManager::instance();
        $data = $db->select('user', ['nickname' => $this->nickname]);

        if (!$data)
            return false;

        foreach($data as $k => $v) {
            $this->cast($k, $v);
        }

        return $this->toArray();
    }
}