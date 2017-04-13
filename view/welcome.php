<?php
    $details = new src\UserDetail();
    $details->getByUserId($auth->user->id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
<!--    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><?=$auth->user->nickname?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
                <a class="btn pull-right btn-default navbar-btn" href="/?signout" role="button">Sign out</a>
            </div>
        </div>
    </nav>



    <h3>Welcome,
        <?php
        if ($details->name)
            echo $details->name, ' (', $auth->user->nickname, ')';
        else
            echo $auth->user->nickname;
        ?>!
    </h3>

    <p>Our finest user since <?=$auth->user->registered ?></p>

    <p>Email <?=$details->email?></p>

    <?php if ($details->image) : ?>
        <img class="img-rounded" src="data:<?=$details->image_mime?>;base64,<?=base64_encode(stripslashes($details->image))?>" />
    <?php endif;?>

</div>

</body>
</html>