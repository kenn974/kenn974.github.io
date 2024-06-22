<?php
require __DIR__ . '/../vendor/autoload.php';

function dbConnect()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/..');
    $dotenv->load();

    //動作確認
    $dbHOST = $_ENV['DB_HOST'];
    $dbUSERNAME= $_ENV['DB_USERNAME'];
    $dbPASSWORD = $_ENV['DB_PASSWORD'];
    $dbDATABASE = $_ENV['DB_DATABASE'];


     $link = mysqli_connect($dbHOST, $dbUSERNAME, $dbPASSWORD, $dbDATABASE);
    //例外処理
    if (!$link) {
        echo 'ERROR: データベースに接続できません' . PHP_EOL;
        echo 'Debbuging ERROR:' . mysql_conect_error() . PHP_EOL;
        exit;
    }
    //returnをしないとdbconect関数にnullを渡してしまう
    return $link;
}

function dropTable($link)
{
    $dropTableSql = 'drop table if exists book_table;';
    $result = mysqli_query($link, $dropTableSql);
    //例外処理
    if ($result) {
        echo 'テーブルを削除しました' . PHP_EOL . PHP_EOL;
    }else {
        echo 'Error: テーブルの削除に失敗しました' . PHP_EOL;
        echo 'Debbuging ERROR:' . mysqli_error($link)  . PHP_EOL;
    }

}

function createTable($link){
    $createTable = <<<EOT
    CREATE TABLE book_table (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    establishment_date DATE,
    founder VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT
    CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET = utf8mb4;
EOT;
    $result = mysqli_query($link, $createTable);
    if ($result) {
        echo 'テーブルを作成しました' . PHP_EOL . PHP_EOL;
    }else{
        echo 'Error: テーブルの作成に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}





$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
