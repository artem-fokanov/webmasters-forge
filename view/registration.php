<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="registration.css">
</head>
<body>
<div class="container">

    <form class="form-horizontal form-registration">
        <div class="form-group">
            <label for="inputNickname" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNickname" placeholder="Nickname">
            </div>
        </div>

        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Full name">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputImage">File input</label>
            <input type="file" id="inputImage">
            <p class="help-block">Example block-level help text here.</p>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPasswordConfirm" class="col-sm-2 control-label">Password confirmation</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Registrate</button>
                <a class="btn btn-default" href="/" role="button">Cancel</a>
            </div>
        </div>
    </form>

</div>

</body>
</html>