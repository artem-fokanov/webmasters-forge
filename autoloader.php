<?php


spl_autoload_register(function ($class_name) {
    include __ROOT__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class_name . '.php';
});

//$obj  = new MyClass1();
//$obj2 = new MyClass2();