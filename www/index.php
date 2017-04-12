<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);

require_once __ROOT__ . DS . 'autoloader.php';

$templates = __ROOT__ . DS . 'view' . DS;

$content = include $templates . 'login.php';

echo $content;
