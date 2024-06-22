<?php

/*$text = '';
$reviews = [];


while (true) {
    echo '1. memoを登録' . PHP_EOL;
    echo '2. memoを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '(1,2,9)から番号を選んで下さい!! :';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        echo 'memoを登録します :';
        $text = trim(fgets(STDIN));
        $reviews[] = $text;
    } elseif ($num === '2') {
        echo 'memoを表示しまーす :'. PHP_EOL;
        foreach ($reviews as $review) {
            echo "$review" . PHP_EOL;
            echo '___________' . PHP_EOL;
        }

    } elseif ($num === '9') {
        echo 'さようなら' . PHP_EOL;
        break;
    }
}
*/




function createReview()
{
        echo '読書ログを登録してください' . PHP_EOL;
        echo '書籍名：';
        $title = trim(fgets(STDIN));

        echo '著者名：';
        $author = trim(fgets(STDIN));

        echo '読書状況（未読,読んでる,読了）：';
        $status = trim(fgets(STDIN));

        echo '評価（5点満点の整数）';
        $score = trim(fgets(STDIN));

        echo '感想：';
        $summary = trim(fgets(STDIN));

        echo '登録が完了しました。'. PHP_EOL;

        return [
      'title' => $title,
      'author'=> $author,
      'status' => $status,
      'score' => $score,
      'summary' => $summary,
    ];
}

$reviews = [];

function displayReview($reviews)
{

    if (is_array($reviews))
    foreach ($reviews as $review) {
        echo $review['title'] . PHP_EOL;
        echo $review['author'] . PHP_EOL;
        echo $review['status'] . PHP_EOL;
        echo $review['score'] . PHP_EOL;
        echo $review['summary'] . PHP_EOL;
        echo '_________________' . PHP_EOL;
    }else {
        echo '配列が未定義又は空です';
    }
}


while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        //リファクタリングする際に１→読書ログの作成をして
        //2→作成した読書ログを$reviews[]に格納する
        //3 →returnする前に登録を完了しましたの表示
        $reviews[] = createReview();

  }
  elseif ($num === '2') {
    //4→格納したものを表示する
        echo '読書ログを表示します。';

        displayReview($reviews);
  }
  }
