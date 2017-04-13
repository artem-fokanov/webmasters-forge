<?php

spl_autoload_register(function ($class_name) {
    $ns = explode('\\', $class_name);
    $path = implode(DS, $ns);
    include __ROOT__  . DS . $path . '.php';
});

function critical_shutdown($exception) {
    echo "В работе приложения произошла ошибка: " , $exception->getMessage(), nl2br("\n");
}

set_exception_handler('critical_shutdown');

function t($str) {
    if (isset($_COOKIE['locale'])) {
        $locale = $_COOKIE['locale'];

        $file = __ROOT__.'/config/locale_'.$locale.'.php';

        if (file_exists($file)) {
            defined('LOCALE_DICT') or define('LOCALE_DICT', include_once $file);
            if (array_key_exists($str, LOCALE_DICT[VIEW]))
                return LOCALE_DICT[VIEW][$str];
        }
    }
    return $str;
}