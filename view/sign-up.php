<?php define('VIEW', basename(__FILE__, '.php')) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=t('Sign up')?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sign-up.css">
</head>
<body>
<div class="container">

    <form name="signup" class="form-horizontal form-registration" method="post" action="/" enctype="multipart/form-data">
        <h2 class="form-signin-heading"><?=t('Signing up')?></h2>

        <div class="form-group required">
            <label for="nickname" class="col-sm-3 control-label"><?=t('Login')?></label>
            <div class="col-sm-9">
                <input type="text" name="nickname" class="form-control" id="nickname" placeholder="<?=t('nickname')?>" autofocus required>
            </div>
            <span id="nickname-help-block" class="help-block"></span>
        </div>

        <div class="form-group required">
            <label for="email" class="col-sm-3 control-label"><?=t('Email')?></label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="email" placeholder="<?=t('email')?>" required>
            </div>
            <span id="email-help-block" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label"><?=t('Name')?></label>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control" id="name" placeholder="<?=t('full name (optional)')?>">
            </div>
            <span id="name-help-block" class="help-block"></span>
        </div>

        <div class="form-group required">
            <label for="password" class="col-sm-3 control-label"><?=t('Password')?></label>
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="password" placeholder="<?=t('password')?>" required>
            </div>
            <span id="password-help-block" class="help-block"></span>
        </div>

        <div class="form-group required">
            <label for="password_confirm" class="col-sm-3 control-label"><?=t('Confirmation')?></label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password_confirm" placeholder="<?=t('password confirmation')?>" required>
            </div>
            <span id="password_confirm-help-block" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="image" class="col-sm-3 control-label"><?=t('Image')?></label>
            <div class="col-sm-9">
                <input type="file" name="image" id="image">
            </div>
            <span id="image-help-block" class="help-block"></span>
        </div>

        <!--<div class="form-group">
            <label class="btn btn-default btn-file">
                Browse <input type="file" hidden>
            </label>
        </div>-->

        <div class="form-group">
            <div class="col-md-offset-3 col-md-6">
                <button type="submit" class="btn btn-lg btn-success btn-block"><?=t('Sign up')?></button>
                <a class="btn btn-link pull-right" href="/" role="button"><?=t('Go back to sign in prompt')?></a>
            </div>
        </div>
    </form>

</div>

<?php include $templates.'footer.php'; ?>

<script type="application/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="js/sign-up.js"></script>
</body>
</html>