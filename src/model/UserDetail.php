<?php

namespace src\model;
use \src\AbstractModel;
use \src\DbManager;

/**
 * Класс-представление записи в таблице wforge.user_detail
 *
 * Class UserDetail
 * @package src
 */
final class UserDetail extends AbstractModel {

    protected $user_id;
    protected $name;
    protected $email;
    protected $image;
    protected $image_mime;

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
            case 'user_id':
                return filter_var($value, FILTER_VALIDATE_INT);

            case 'name':
                $valid = true;
//                if (!preg_match('/^[^0-9]\w+$/', $value))
//                    $valid = false;

                if (strlen($value) > 100)
                    $valid = false;

                return $valid;

            case 'email':
                $valid = true;

                if (strlen($value) > 50)
                    $valid = false;

                if (filter_var($value, FILTER_VALIDATE_EMAIL) === false)
                    $valid = false;

                return $valid;

            default:
                return true;
        }
    }

    protected function cast($property, $value)
    {
        if (property_exists($this, $property)) {
            switch ($property) {
                case 'user_id':
                    $value = intval($value);
                    break;
                case 'name':
                    $value = filter_var($value, FILTER_SANITIZE_STRING);
                    break;
                case 'email':
                    $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                    break;
                default:
                    break;
            }

            $this->$property = $value;
        }
    }

    public function getByUserId($userId) {
        $db = DbManager::instance();
        $data = $db->select('user_detail', ['user_id' => $userId]);

        foreach($data as $k => $v) {
            $this->cast($k, $v);
        }

        return $this->toArray();
    }
}