<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">test php</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
                <a class="btn pull-right btn-default navbar-btn" href="/?signout" role="button">Sign out</a>
            </div>
        </div>
    </nav>

    <h3>Welcome, <?=$auth->user->getNickname()?>!</h3>
    <div class="img-rounded" style="width: 150px; height: 150px; background-color: #843534"></div>
</div>

</body>
</html>