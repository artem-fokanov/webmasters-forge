<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
$templates = __ROOT__ . DS . 'view' . DS;
require_once __ROOT__ . DS . 'autoloader.php';

$user = new src\Auth();

if ($user->isAuthentificated()) {
    $content = include $templates . 'welcome.php';
} else {
    $content = include $templates . 'login.php';
}

echo $content;
