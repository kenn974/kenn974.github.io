<?php
//companiesテーブルに接続するためのコード
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log' );
echo 'データベースに接続出来ました'.PHP_EOL;

//例外処理
if (!$link) {
    echo 'Error: データベースに接続できませんでした'.PHP_EOL;
    echo 'Debugging error: '.mysql_conect_error() . PHP_EOL;
    exit;
}

$sql = 'select name, founder from companies';
$results = mysqli_query($link, $sql);

while ($company = mysqli_fetch_assoc($results)) {
    //データの表示の処理を行う
    echo '会社名' . $company['name'] . PHP_EOL;
    echo '代表者名' . $company['founder'] . PHP_EOL;
}

mysqli_free_result($results);
//companiesテーブルにPHPからデータを追加する
//1.ヒアドキュメントの宣言→作成

/*$sql = <<<EOT
INSERT INTO companies (
    name,
    establishment_date,
    founder
) VALUES (
    'SmartHR Inc',
    '2013-01-23',
    'Shoji Miyata'
)
EOT;

$result = mysqli_query($link, $sql);
if ($result) {
    echo 'データを追加しました' . PHP_EOL;
} else {
 //SQLの実行に失敗した場合
    echo 'Error: データの追加に失敗しました' . PHP_EOL;
    echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
}*/
//mysqli_error($link)でERROR内容が表示される!!

mysqli_close($link);
echo 'データベースとの接続を切断しました'.PHP_EOL;
