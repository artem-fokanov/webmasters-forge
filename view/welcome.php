<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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

    <h3>Welcome, <?=$auth->user->nickname ?>!</h3>
    <p>Finest user since <?=$auth->user->registered ?></p>
    <?php
        $a = new src\UserDetail();
        $a->getByUserId($auth->user->id);

        if ($a->image) : ?>
            <img class="img-rounded" src="data:<?=$a->image_mime?>;base64,<?=base64_encode(stripslashes($a->image))?>" />
        <?php endif;?>
</div>

</body>
</html>