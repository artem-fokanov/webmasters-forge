<?php

spl_autoload_register(function ($class_name) {
    include __ROOT__ . DS . 'src' . DS . $class_name . '.php';
});

function critical_shutdown($exception) {
    echo "В работе сервера произошла ошибка: " , $exception->getMessage(), nl2br("\n");
}

set_exception_handler('critical_shutdown');