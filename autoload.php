<?php

function autoloaderFunction(string $class): void
{
    $prefix = 'App\\';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;

    $relative_class = substr($class, $len);                       

    $base_dir = __DIR__ . '/App/';
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file; 
    }else {
        echo "Failed to load: $file<br>";
    }
}

spl_autoload_register('autoloaderFunction');