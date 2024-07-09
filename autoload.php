<?php
declare(strict_types=1);

function load($classname): void
{
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';
    if (file_exists($file)) {
        require_once($file);
    }
}
// регистрация
spl_autoload_register('load');
