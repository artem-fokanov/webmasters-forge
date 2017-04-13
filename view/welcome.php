<?php
    define('VIEW', basename(__FILE__, '.php'));
    $details = new src\UserDetail();
    $details->getByUserId($auth->user->id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=t('Welcome')?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><?=$auth->user->nickname?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
                <a class="btn pull-right btn-default navbar-btn" href="/?signout" role="button"><?=t('Sign out')?></a>
            </div>
        </div>
    </div>
</nav>
<div class="container">



    <h3><?=t('Welcome')?>,
        <?php
            if ($details->name)
                echo t($details->name), ' (', $auth->user->nickname, ')';
            else
                echo $auth->user->nickname;
        ?>!
    </h3>

    <p><?=t('Our finest user since')?> <?=$auth->user->registered ?></p>

    <p><?=t('Email')?> <?=$details->email?></p>

    <?php if ($details->image) : ?>
        <img class="img-rounded" src="data:<?=$details->image_mime?>;base64,<?=base64_encode(stripslashes($details->image))?>" />
    <?php endif;?>

</div>

<?php include $templates.'footer.php'; ?>

</body>
</html>