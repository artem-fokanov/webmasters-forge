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