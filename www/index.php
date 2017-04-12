<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
require_once __ROOT__ . DS . 'autoloader.php';

if (isset($_POST['nickname'], $_POST['password'])) {
    $loginUser = src\User::newFromArray($_POST);
} else {
    $loginUser = new src\User();
}

$auth = new src\Auth($loginUser);
unset($loginUser);

if (isset($_GET['signout'])) {
    $auth->unAuth();
}

$templates = __ROOT__ . DS . 'view' . DS;

if ($auth->isAuthentificated()) {
    include $templates.'welcome.php';
} elseif(isset($_GET['signup'])) {
    include $templates.'sign-up.php';
} else {
    include $templates.'sign-in.php';
}
