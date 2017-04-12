<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="sign-up.css">
</head>
<body>
<div class="container">

    <form class="form-horizontal form-registration" method="post" action="/" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Signing up</h2>

        <div class="form-group">
            <label for="inputNickname" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-10">
                <input type="text" name="nickname" class="form-control" id="inputNickname" placeholder="Nickname" autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Full name">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPasswordConfirm" class="col-sm-2 control-label">Password confirmation</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirm" class="form-control" id="inputPasswordConfirm" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputImage">Image</label>
            <input type="file" name="image" id="inputImage">
        </div>

        <!--<div class="form-group">
            <label class="btn btn-default btn-file">
                Browse <input type="file" hidden>
            </label>
        </div>-->

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success btn-block">Sign up</button>
            <a class="btn btn-link pull-right" href="/" role="button">Go back to sign in prompt</a>
        </div>
    </form>

</div>

</body>
</html>