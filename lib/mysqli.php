<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

function dbConnect()
{
    $DB_HOST = $_ENV['DB_HOST'];
    $DB_USERNAME = $_ENV['DB_USERNAME'];
    $DB_PASSWORD = $_ENV['DB_PASSWORD'];
    $DB_DATABASE = $_ENV['DB_DATABASE'];
    $link = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if (!$link) {
        echo 'Error: データベースに接続できません' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}


