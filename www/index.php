<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);

require_once __ROOT__ . DS . 'autoloader.php';

try {
    $db = new src\DbManager();
} catch (PDOException $exception) {
    die();
}

$content = include __ROOT__ . DS . 'view' . DS . 'login.php';

echo $content;