<?php
//require→外部のファイルを読み込む __DIR__←現在のディレクトリを表す ..→1つ上のディレクトリに行ける
require __DIR__ . '/../../vendor/autoload.php';
function dbConnect()
{
    //今自分のディレクトリと同じディレクトリにある.envファイルをcreateImmutableで環境変数として読み込んでいる
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUsername = $_ENV['DB_USERNAME'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);
    //例外処理
    if (!$link) {
        echo 'ERROR: データベースに接続できません' . PHP_EOL;
        echo 'Debbuging ERROR:' . mysql_conect_error()  . PHP_EOL;
        exit;
    }
    //returnをしないとdbconect関数にnullを渡してしまう
    return $link;
}
