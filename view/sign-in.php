<?php define('VIEW', basename(__FILE__, '.php')) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=t('Sign in')?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sign-in.css">
</head>
<body>

<div class="container">

    <form class="form-signin" method="post" name="signin">

        <h2 class="form-signin-heading"><?=t('Please sign in')?></h2>

        <?php if (isset($authException)) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?=t($authException)?>
            </div>
        <?php endif; ?>

        <label for="inputNick" class="sr-only"><?=t('Login')?></label>
        <input type="text" name="nickname" id="inputNick" class="form-control" placeholder="<?=t('Login')?>" required autofocus>

        <label for="inputPassword" class="sr-only"><?=t('Password')?></label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="<?=t('Password')?>" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=t('Sign in')?></button>

        <h4 class="form-signin-heading">
            <?=t('Don\'t have a profile?')?>
            <a class="btn btn-default" href="/?signup" role="button"><?=t('Sign up!')?></a>
        </h4>
    </form>

</div>

<?php include $templates.'footer.php'; ?>

<script type="application/javascript" src="js/jquery-3.2.1.min.js"></script>

<?php if (isset($authException)) : ?>
<script type="application/javascript" src="js/bootstrap.min.js"></script>
<?php endif; ?>
</body>
</html>