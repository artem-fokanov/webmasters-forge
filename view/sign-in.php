<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sign-in.css">
    <script type="application/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <form class="form-signin" method="post" name="signin">

        <h2 class="form-signin-heading">Please sign in</h2>

        <?php if (isset($loginException)) : ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Incorrect username or password.
        </div>
        <?php endif; ?>

        <label for="inputNick" class="sr-only">Login</label>
        <input type="text" name="nickname" id="inputNick" class="form-control" placeholder="Login" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <h4 class="form-signin-heading">Don't have a profile?
            <a class="btn btn-default" href="/?signup" role="button">Sign up!</a>
        </h4>
    </form>

</div>

</body>
</html>