<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sign-up.css">
    <script type="application/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="container">

    <form name="signup" class="form-horizontal form-registration" method="post" action="/" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Signing up</h2>

        <div class="form-group">
            <label for="nickname" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-10">
                <input type="text" name="nickname" class="form-control" id="nickname" placeholder="Nickname" autofocus required>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" placeholder="Full name">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="password" placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirm" class="col-sm-2 control-label">Confirmation</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirm" placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
                <input type="file" name="image" id="image">
            </div>
<!--            <span id="helpBlock2" class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
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

<script type="application/javascript" src="js/sign-up.js"></script>
</body>
</html>