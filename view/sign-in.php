<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sign-in.css">
</head>
<body>

<div class="container">

    <form class="form-signin" method="post" name="signin">
        <h2 class="form-signin-heading">Please sign in</h2>

        <label for="inputNick" class="sr-only">Login</label>
        <input type="text" name="nickname" id="inputNick" class="form-control" placeholder="Login" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <h2 class="form-signin-heading">Don't have a profile?</h2>
        <a class="btn btn-success btn-block" href="/?signup" role="button">Sign up!</a>
    </form>

</div>

</body>
</html>