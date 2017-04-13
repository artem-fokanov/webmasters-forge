<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
require_once __ROOT__ . DS . 'autoloader.php';


if (isset($_GET['ru']) || isset($_GET['en'])) {
    setcookie('locale', isset($_GET['ru']) ? 'ru' : 'en');
    header('Location: '. $_SERVER['HTTP_REFERER']);
}

try {

    if (isset($_POST['nickname'], $_POST['password'])) {
        $login = true;
        $post = $_POST;
        $user = src\User::newFromArray($post);

        // регистрация
        if (isset($_POST['email'])) {

            // шифруем пароль
            $post['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);

            // вначале получить id
            if (isset($_FILES['image'])) {
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
                $mime = $_FILES['image']['type'];
                $post = array_merge($post, ['image' => $image, 'image_mime' => $mime]);
            }
            // создаем модель юзера
            $user = src\User::newFromArray($post);

            $db = \src\DbManager::instance();
            $db->beginTransaction();

            try {
                // записываем все в бд
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

    if (isset($login) && !$auth->isAuthentificated())
        throw new src\AuthException();

    unset($user);

} catch (src\AuthException $e) {
    $loginException = $e->getMessage();
}

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