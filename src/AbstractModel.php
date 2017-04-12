<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 12.04.2017
 * Time: 6:31
 */

namespace src;


abstract class AbstractModel {

    public static function newFromArray(array $data) {
        $class = get_called_class();
        $modelEntity = new $class();
        return $modelEntity;
    }

    abstract protected function validate($property, $value);

    abstract protected function cast($property, $value);

    public function toArray() {
        $vars = $this->getProperties();
        $result = [];
        foreach (array_keys($vars) as $property) {
            $result[$property] = $this->$property;
        }
        return $result;
    }

    protected function getProperties() {
        return get_class_vars(get_class($this));
    }
}