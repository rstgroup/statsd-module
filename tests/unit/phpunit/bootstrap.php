<?php

$autoload = __DIR__ . '/../../../vendor/autoload.php';

if (file_exists($autoload)) {
    require_once $autoload;
} else {
    echo "Missing autoload file. Did you run `composer`?";
    exit(0);
}
