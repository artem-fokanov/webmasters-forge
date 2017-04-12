<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
require_once __ROOT__ . DS . 'autoloader.php';

if (isset($_POST['nickname'], $_POST['password'])) {
    $loginUser = src\User::newFromArray($_POST);
} else {
    $loginUser = null;
}

$auth = new src\Auth($loginUser);

if (isset($_GET['logout'])) {
    $auth->unAuth();
    header('Location: /');
}

$templates = __ROOT__ . DS . 'view' . DS;
if ($auth->isAuthentificated()) {
    include $templates.'welcome.php';
} else {
    include $templates.'login.php';
}
