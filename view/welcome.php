<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="signin.css">-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="collapsed navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-3" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a href="#" class="navbar-brand">Brand</a></div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
            <a class="btn pull-right btn-default navbar-btn" href="/?logout" role="button">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h3>Welcome, <?=$loginUser->getNickname()?>!</h3>
    <div class="img-rounded" style="width: 150px; height: 150px; background-color: #843534"></div>
</div>

</body>
</html>