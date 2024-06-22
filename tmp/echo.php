<?php

function validate($review)
{
    //errorを格納するためのから配列を定義する
    $errors = [];

    //書籍名が正しく入力されているかチェック
    if (!strlen($review['custom'])) {
        $errors['custom'] = '書籍名を入力してください';
    } elseif (strlen($review['custom']) > 255 ) {
        $errors['custom'] = '書籍名は255文字以内で入力してください';
    }
    //著者名が正しく入力されているかチェック
    if (!strlen($review['auther'])) {
        $errors['auther'] = '著者名を入力してください';
    } elseif (strlen($review['auther']) > 255) {
        $errors['auther'] = '著者名は255文字以内で入力してください';
    }

    //読書状況が正しく入力されているかチェック
    if (!in_array($review['status'], ['未読', '読んでる', '読了'], true)) {
        $errors['status'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }
    //感想が正しく入力されているかチェック
    if (!strlen($review['impressions'])) {
        $errors['impressions'] = '感想を入力してください';
    } elseif (strlen($review['impressions']) > 255) {
        $errors['impressions'] = '感想は255文字以内で入力してください';
    }

    //評価が正しく入力されているかチェック
    if ($review['estimation'] < 1 || $review['estimation'] > 5) {
        $errors['estimation'] = '評価は1~5の整数を入力してください';
    }
    //全部の処理が終わったら、ERROR内容を返す！
    return $errors;
}
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    //例外処理
    if (!$link) {
        echo 'ERROR: データベースに接続できません' . PHP_EOL;
        echo 'Debbuging ERROR:'  . PHP_EOL;
        exit;
    }

    $review = [];

function createReview($link)
{
        echo '読書ログを登録してください' . PHP_EOL;
        echo '書籍名：';
        $review['custom'] = trim(fgets(STDIN));

        echo '著者名：';
        $review['auther'] = trim(fgets(STDIN));

        echo '読書状況（未読,読んでる,読了）：';
        $review['situation'] = trim(fgets(STDIN));

        echo '評価（5点満点の整数）:';
        $review['estimation'] = (int)trim(fgets(STDIN));

        echo '感想：';
        $review['impressions'] = trim(fgets(STDIN));

        // validation errorがあった場合の例外処理
        $validated = validate($review);
        if (count($validated) > 0) {
            foreach ($validated as $error) {
                echo $error . PHP_EOL;
            }
            return;
        }
//入力された値をSQL文で保存している
$sql = <<<EOT
    INSERT INTO book_table(
    custom,
    auther,
    situation,
    estimation,
    impressions
) VALUES (
    "{$review['custom']}",
    "{$review['auther']}",
    "{$review['situation']}",
    "{$review['estimation']}",
    "{$review['impressions']}"
)
EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    } else {
        echo 'Error: データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}

    echo '登録されている読書ログを表示します' . PHP_EOL;
    $sqls = "select * from book_table";
    $results = mysqli_query($link, $sqls);

    while($book_table =  mysqli_fetch_assoc($results)) {
        //先ず動作確認 …OK
        //var_export($book_table);
        echo '書籍名:' . $book_table['custom'] . PHP_EOL;
        echo '著者名:' . $book_table['auther'] . PHP_EOL;
        echo '読書状況（未読,読んでる,読了:' . $book_table['situation'] . PHP_EOL;
        echo '評価（5点満点の整数）:' . $book_table['estimation'] . PHP_EOL;
        echo '感想:' . $book_table['impressions'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
        /*
        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
        return  [
            'title' => $title,
            'auther' => $auther,
            'status' => $status,
            'score' => $score,
            'summary' => $summary,
        ];
        */


//読書ログの表示の部分をリファクタリングしたい

/*function listReviews($reviews)
{
    echo '登録されている読書ログを表示します' . PHP_EOL;

    foreach ($reviews as $review) {
        echo '書籍名：' . $review['custom'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['situation'] . PHP_EOL;
        echo '評価：' . $review['estimation'] . PHP_EOL;
        echo '感想：' . $review['impressions'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}*/


$reviews = [];
while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）:';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createReview($link);
    } elseif ($num === '2') {
        listReviews($reviews);
    } elseif ($num === '9') {
        mysqli_close($link);
        break;
    }
}
