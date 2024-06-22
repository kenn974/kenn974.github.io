<?php
//先ずは大枠を書く
//phpでMySQLに接続・命令・切断したい
//関数は呼び出し側から書く
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'データベースに接続出来なかった' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $link;
}

function dropTable($link)
{
    $dropTableSql = 'DROP TABLE IF EXISTS book_table;';
    $result = mysqli_query($link, $dropTableSql);
    if ($result) {
        echo 'データの削除に成功しました' . PHP_EOL;
    } else {
        //SQLの実行に失敗した場合
        echo 'Error: データの削除に失敗しました' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }
}


function createTable($link)
{
    $createTableSql =<<<EOT
    CREATE TABLE companies (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    establishment_date DATE,
    founder VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT
    CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET = utf8mb4;

EOT;
    $result = mysqli_query($link, $createTableSql);
    if ($result) {
        echo 'データの登録に成功しました' . PHP_EOL;
    } else {
        //SQLの実行に失敗した場合
        echo 'Error: データの登録に失敗しました' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }
}




$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
