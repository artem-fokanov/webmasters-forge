<?php

namespace src;

/**
 * Менеджер по работе с БД
 *
 * Class DbManager
 * @package src
 */
class DbManager extends \PDO {

    static private $instance = null;

    public function __construct()
    {
        $config = require __ROOT__ . DS . 'config'. DS . 'db.php';
        parent::__construct($config['dsn'], $config['user'], $config['pass']);
    }

    private function __clone() {}

    /**
     * Обращение к синглтон-классу
     *
     * @return null|DbManager
     */
    static function instance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Операция записи в БД
     *
     * @param $table - имя таблицы
     * @param $params - параметры для записи
     * @return int - возвращает id записи
     */
    public function insert($table, $params) {
        $db = self::instance();
        $columns = implode(', ', array_keys($params));
        $values = implode(', ', array_map([$db, 'prepareParam'], array_keys($params)));

        $sql = "insert into wforge.$table ($columns) values ($values)";

        $statement = $db->prepare($sql);
        foreach ($params as $column => $value) {
            $statement->bindValue($this->prepareParam($column), $this->prepareValue($value));
        }
        $result = $statement->execute();

        if (!$result)
            throw new \PDOException('Can\'t insert');

        return intval($db->lastInsertId());
    }

    /**
     * Операция выборки из БД
     *
     * @param $table - имя таблицы
     * @param $where - параметры выборки
     * @return mixed
     */
    public function select($table, $where) {
        $db = self::instance();
        $columns = array_keys($where);

        $sql = "select * from $table where ";
        foreach ($columns as $col) {
            $sql .= "$col = :$col";
        }
        $sql .= ";";
        $statement = $db->prepare($sql);

        foreach ($where as $column => $value) {
            $statement->bindValue($this->prepareParam($column), $this->prepareValue($value));
        }
        $statement->execute();

        return $statement->fetch(self::FETCH_ASSOC);
    }

    protected function prepareParam($param) {
        return ':'.$param;
    }

    protected function prepareValue($value) {
        if (is_null($value))
            return self::PARAM_NULL;

        // экранирование
        return $value;
    }
}