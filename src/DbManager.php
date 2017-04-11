<?php

namespace src;

class DbManager extends \PDO {

    public function __construct()
    {
        $config = require __ROOT__ . DS . 'config'. DS . 'db.php';
        parent::__construct($config['dsn'], $config['user'], $config['pass']);
    }
}