<?php

namespace src;


abstract class AbstractModel {

    /**
     * Создание класса из массива свойств
     * в наследнике стоит реализовать основную логику
     *
     * @param array $data
     * @return mixed
     */
    public static function newFromArray(array $data) {
        $class = get_called_class();
        $modelEntity = new $class();
        return $modelEntity;
    }

    /**
     * Валидация значений
     *
     * @param $property - свойство для валидации
     * @param $value - значение
     * @return boolean
     */
    abstract protected function validate($property, $value);

    /**
     * Фильтрация и запись значения в свойство модели
     *
     * @param $property - зарегистрированное в модели свойство
     * @param $value - значение
     * @return mixed
     */
    abstract protected function cast($property, $value);

    /**
     * Преобразование свойств модели в массив
     *
     * @return array
     */
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

    public function __get($name) {
        return $this->$name;
    }
}