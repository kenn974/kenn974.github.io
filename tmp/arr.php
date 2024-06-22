<?php


$link = mysqli_connect('db', 'book_log', 'pass', 'book_log' );
    echo '接続できました' . PHP_EOL;

if (!$link){
    //例外処理を行う…接続できませんと出力しておき、ERROR内容がlogに出るようにする
    echo 'Error: データベースに接続できませんでした'.PHP_EOL;
    echo 'Debugging error: '.mysql_conect_error() . PHP_EOL;
    exit;
}

$sql = <<<EOT
    INSERT INTO book_table (
    custom,
    auther,
    situation,
    estimation,
    impressions
) VALUES (
    'KINGUDAMU',
    'Hara',
    'MIDOKU',
    '3',
    'so interesting'
)
EOT;
 $result = mysqli_query($link, $sql);
 //例外処理すること
 if ($result) {
    echo 'データを追加出来たドン'  . PHP_EOL;
 } else {
    echo 'Error: データを追加できませんでした'.PHP_EOL;
    echo 'Debugging error: '.mysql_error($link) . PHP_EOL;
 }

/*mysqli_close($link);
    echo '接続を切断しました' . PHP_EOL;*/
