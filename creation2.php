<?php

require_once __DIR__ . '/companies/lib/mysqli.php';

 function createBooklog($link, $booklog) {
    $sql = <<< EOT
    INSERT INTO book_table(
       name,
       auther,
       situation,
       score,
       emotions
    )  VALUES (
       "{$booklog['name']}",
       "{$booklog['auther']}",
       "{$booklog['situation']}",
       "{$booklog['score']}",
       "{$booklog['emotions']}"
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
       error_log('Error: fail to create company');
       error_log('DebbugingError:' . mysqli_error($link));
    }
 }

 //バリデーションする
//書籍名が正しく入力されているかチェック
function validate($booklog) {
   $errors = [];
    if (!strlen($booklog['name'])) {
        $errors['name'] = '書籍名を入力してください';
    } elseif (strlen($booklog['name']) > 255 ) {
        $errors['name'] = '書籍名は255文字以内で入力してください';
    }
    //著者名が正しく入力されているかチェック
    if (!strlen($booklog['auther'])) {
        $errors['auther'] = '著者名を入力してください';
    } elseif (strlen($booklog['auther']) > 255) {
        $errors['auther'] = '著者名は255文字以内で入力してください';
    }

    //読書状況が正しく入力されているかチェック
    if (!in_array($booklog['situation'], ['未読', '読んでる', '読了'])) {
        $errors['situation'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }

    //評価が正しく入力されているかチェック
    if ($booklog['score'] < 1 || $booklog['score'] > 5) {
        $errors['score'] = '評価は1~5の整数を入力してください';
    }

     //感想が正しく入力されているかチェック
    if (!strlen($booklog['emotions'])) {
        $errors['emotions'] = '感想を入力してください';
    } elseif (strlen($booklog['emotions']) > 255) {
        $errors['emotions'] = '感想は255文字以内で入力してください';
    }
    //全部の処理が終わったら、ERROR内容を返す！
    return $errors;
}

//var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $situation = '';
    if (array_key_exists('situation', $_POST)) {
        $situation = $_POST['situation'];
        $booklog = [
        'name' => $_POST['name'],
        'auther' => $_POST['auther'],
        'situation' => $situation,
        'score' => $_POST['score'],
        'emotions' => $_POST['emotions'],
];

$errors = validate($booklog);
   if (!count($errors)) {

    $link = dbConnect();

    createBooklog($link, $booklog);

    mysqli_close($link);

    header("Location: index1.php");
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = '';
    if (array_key_exists('status', $_POST)) {
        $status = $_POST['status'];
    }

    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $status,
        'score' => $_POST['score'],
        'summary' => $_POST['summary']
    ];

    // バリデーション処理を追加
    $errors = validate($review);

    if (!count($errors)) {
        $link = dbConnect();
        createReview($link, $review);
        mysqli_close($link);
        header("Location: index1.php");
    }
}
