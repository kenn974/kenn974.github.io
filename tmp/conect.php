<?php

$conect = mysqli_connect('db', 'book_log', 'pass', 'book_log' );
//動作確認
echo '接続出来ました～' .PHP_EOL;

if (!$conect) {
    //  例外処理をしておく…具体的にはデータベースに接続出来なかったことを想定しておく
    echo 'データベースに接続出来なかった'.PHP_EOL;
    echo 'Debugging error: '.mysql_conect_error() . PHP_EOL;
    exit;
}

mysqli_close($conect);
//動作確認
echo '接続切ったドン' .PHP_EOL;

