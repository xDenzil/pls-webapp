<?php

session_start();
$MAPS_API_KEY = 'AIzaSyCAKrYd2b-ceSJOqO-ejr1R1c2qXB51SaM';

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
if (getenv('MODE') == 'PRODUCTION') {
    $dotenv->load();
}
