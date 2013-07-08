<?php

spl_autoload_register(function ($class) {
    if (0 === strpos($class, 'yapf')) {
        if (file_exists($file = dirname(__FILE__) . str_replace(array('_', "\0", 'yapf'), array('/', '', ''), $class) . '.php')) {
            require_once $file;
        }
        return;
    } elseif (file_exists($file = dirname(__FILE__) . '/' . str_replace(array('_', "\0"), array('/', ''), $class) . '.php')) {
        require_once $file;
    }
});