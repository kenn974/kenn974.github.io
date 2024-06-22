<?php

$book = [
    'name' => '',
    'auther' => '',
    'situation' => '未読',
    'score' => '',
    'emotions' => ''
];

$errors = [];

function review()
{
    global $book;
    // $bookを使用
}

function sum()
{
    global $errors;
    // $errorsを使用
}

sum();
review();


$title = '読書ログの登録';
$content = __DIR__ . "/view/form1.php";
include 'view/layout.php';
