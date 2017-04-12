<?php

function register() {
    $user = src\User::newFromArray([
        'nickname' => 'testUser',
        'password_hash' => password_hash('123123', PASSWORD_DEFAULT)
    ]);

    $data = array_filter($user->toArray());

    $db = src\DbManager::instance();

    $insert = 'insert into wforge.user (' . implode(',', array_keys($data)) . ') VALUES(:0, :1)';
    $statement = $db->prepare($insert);
    $statement->bindValue(':0', $data['nickname']);
    $statement->bindValue(':1', $data['password_hash']);
    $statement->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="signin.css">
</head>
<body>

<div class="container">

    <form class="form-signin" method="post" name="login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputNick" class="sr-only">Login</label>
        <input type="text" name="nickname" id="inputNick" class="form-control" placeholder="Login" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div>

</body>
</html>