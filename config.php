<?php
session_start();

if (getenv('ENV_MODE') != 'PRODUCTION') {
    require_once __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}
