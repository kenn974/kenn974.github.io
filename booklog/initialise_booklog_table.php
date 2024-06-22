<?php
require_once __DIR__ . '/library/mysql.php';

function dropTable($link)
{
    $dropTableSql = 'drop table if exists book_log;';
    $result = mysqli_query($link, $dropTableSql);
    //例外処理
    if ($result) {
        echo 'テーブルを削除しました' . PHP_EOL;
    } else {
        echo 'テーブルを削除に失敗しました' . PHP_EOL;
        echo 'Debugging error' . mysqli_error($link) . PHP_EOL;
    }
}

function createBook($link)
{
    $createBookSql = <<< EOT
    CREATE TABLE book_log (
        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        auther VARCHAR(255),
        situation VARCHAR(255),
        score INTEGER NOT NULL,
        emotions VARCHAR(255),
        created_at TIMESTAMP NOT NULL DEFAULT
        CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET = utf8mb4;
EOT;
    $result = mysqli_query($link, $createBookSql);
    if ($result) {
        echo 'テーブルを作成しました' . PHP_EOL . PHP_EOL;
    } else {
        echo 'Error: テーブルの作成に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}

$link = dbConnect();
dropTable($link);
createBook($link);
mysqli_close($link);
