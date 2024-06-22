<?php
//form.phpの$errorsが未定義なので、定義する
//初めて登録フォームに来たところのシーンなので
$company = [
    'name' => '',
    'establishment_date' => '',
    'founder' => ''
];

$errors = [];

$title = '会社情報の登録';
$content =
__DIR__ . '/views/form.php';

include __DIR__ . '/views/layout.php';
