<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);

require_once __ROOT__ . DS . 'autoloader.php';

try {
    $db = new src\DbManager();
    $rows = $db->query('select * from wforge.user');
    foreach ($rows as $r) {
        echo 1;
    }

    $user = src\User::newFromArray([
        'id' => 1,
        'nickname' => 'testUser',
        'password_hash' => password_hash('123123', PASSWORD_DEFAULT)
    ]);
    $data = $user->toArray();
} catch (PDOException $exception) {
    die();
}

$content = include __ROOT__ . DS . 'view' . DS . 'login.php';

echo $content;