<?php

// автозагрузка, обработчик критического падения, i18n
require_once dirname(dirname(__FILE__)) . '/autoloader.php';

// действие смены локали
if (isset($_GET['ru']) || isset($_GET['en'])) {
    controllerLocale();
}

$login = isset($_POST['nickname'], $_POST['password']);

// регистрация
if ($login && isset($_POST['email'])) {
    $post = $_POST;
    $register = true;

    // шифруем пароль
    $post['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);

    if (isset($_FILES['image'])) {
        $post = array_merge($post, [
            'image' => addslashes(file_get_contents($_FILES['image']['tmp_name'])),
            'image_mime' => $_FILES['image']['type']
        ]);
    }

    // создаем модель юзера
    $user = src\model\User::newFromArray($post);

    $db = \src\DbManager::instance();
    $db->beginTransaction();

    try {
        // записываем все в бд
        $userId = $db->insert('user', array_filter($user->toArray()));

        $post = array_merge($post, ['user_id' => $userId]);

        $userDetail = src\model\UserDetail::newFromArray($post);

        $db->insert('user_detail', $userDetail->toArray());
        $db->commit();

    } catch (PDOException $e) {
        $db->rollback();
        $register = false;
        $user = src\model\User::newFromArray([]);
    }
}
// авторизация
elseif ($login) {
    $post = $_POST;
    $user = src\model\User::newFromArray($post);
}
else {
    $user = new src\model\User();
}

try {
    $auth = new src\Auth($user);
    unset($user);

    if (isset($register)) {
        if (!$register)
            throw new src\AuthException('', src\AuthException::USER_WITH_SUCH_LOGIN_EXIST);
    }

    if ($login && $auth->isAuthentificated() === false)
        throw new src\AuthException('', src\AuthException::USER_DOESNT_EXIST);

} catch (src\AuthException $e) {
    $authException = $e->getMessage();
}

// действие деавторизации
if (isset($_GET['signout'])) {
    controllerLogout($auth);
}

$templates = __ROOT__ . DS . 'view' . DS;

if ($auth->isAuthentificated()) {
    include $templates.'welcome.php';
}
elseif (isset($_GET['signup']) || (isset($register) && $register === false) ) {
    include $templates.'sign-up.php';
}
else {
    include $templates.'sign-in.php';
}

// Все отработало - завершаем работу
exit();



function controllerLocale() {
    setcookie('locale', isset($_GET['ru']) ? 'ru' : 'en');
    header('Location: '. $_SERVER['HTTP_REFERER']);
}

function controllerLogout(src\Auth $auth) {
    $auth->unAuth();
}
