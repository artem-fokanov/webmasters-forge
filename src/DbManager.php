<?php

namespace src;

class DbManager extends \PDO {

    static private $instance = null;

    public function __construct()
    {
        $config = require __ROOT__ . DS . 'config'. DS . 'db.php';
        parent::__construct($config['dsn'], $config['user'], $config['pass']);
    }

    private function __clone() {}

    static function instance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert($table, $params) {
        $db = self::instance();
        $columns = implode(', ', array_keys($params));
        $values = implode(', ', array_map([$db, 'prepareParam'], array_keys($params)));

        $sql = "insert into wforge.$table ($columns) values ($values)";

        $statement = $db->prepare($sql);
        foreach ($params as $column => $value) {
            $statement->bindParam($this->prepareParam($column), $this->prepareValue($value));
        }

        return $db->lastInsertId();
    }

    protected function prepareParam($param) {
        return ':'.$param;
    }

    protected function prepareValue($value) {
        if (is_null($value))
            return self::PARAM_NULL;

        // сюда прицепить экранирование
        return $value;
    }
}