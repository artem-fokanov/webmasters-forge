<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
require_once __ROOT__ . DS . 'autoloader.php';

if (isset($_POST['nickname'], $_POST['password'])) {
    $user = src\User::newFromArray($_POST);

    if (isset($_POST['email'])) {
        // вначале получить id
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
        $detail = array_merge($_POST, ['image' => $image]);
        $userDetail = src\UserDetail::newFromArray($detail);
    }

} else {
    $user = new src\User();
}

$auth = new src\Auth($user);
unset($user);

if (isset($_GET['signout'])) {
    $auth->unAuth();
}

$templates = __ROOT__ . DS . 'view' . DS;

if ($auth->isAuthentificated()) {
    include $templates.'welcome.php';
}
elseif (isset($_GET['signup'])) {
    include $templates.'sign-up.php';
}
else {
    include $templates.'sign-in.php';
}
