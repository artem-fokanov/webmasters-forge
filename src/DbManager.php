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
}