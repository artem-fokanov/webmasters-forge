<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
require_once __ROOT__ . DS . 'autoloader.php';

if (isset($_POST['nickname'], $_POST['password'])) {
    $post = $_POST;
    $user = src\User::newFromArray($post);

    // регистрация
    if (isset($_POST['email'])) {
        $post['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);
        // вначале получить id
        if (isset($_FILES['image'])) {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
            $mime = $_FILES['image']['type'];
            $post = array_merge($post, ['image' => $image, 'image_mime' => $mime]);
        }
        $user = src\User::newFromArray($post);

        $db = \src\DbManager::instance();
        $db->beginTransaction();

        try {
            $userId = $db->insert('user', array_filter($user->toArray()));

            $post = array_merge($post, ['user_id' => $userId]);

            $userDetail = src\UserDetail::newFromArray($post);

            $userDetailId = $db->insert('user_detail', $userDetail->toArray());

            $db->commit();

            header('Location: /');
        } catch (PDOException $e) {
            $db->rollback();
        }

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
