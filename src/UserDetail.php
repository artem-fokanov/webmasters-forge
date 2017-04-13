<?php

namespace src;


class UserDetail extends AbstractModel {

    protected $user_id;
    protected $name;
    protected $email;
    protected $image;

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
                return filter_var($value, FILTER_SANITIZE_STRING);

            case 'email':
                return filter_var($value, FILTER_VALIDATE_EMAIL);

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