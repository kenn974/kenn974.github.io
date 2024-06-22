<?php
//ヴァリデーショが上２つしかきいていない
require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    global $review;
    $sql = <<<EOT
        INSERT INTO reviews(
            title,
            author,
            status,
            score,
            summary
        ) VALUES (
            "{$review['title']}",
            "{$review['author']}",
            "{$review['status']}",
            "{$review['score']}",
            "{$review['summary']}"
        )
EOT;
    $result = mysqli_query($link, $sql);

    if (!$result) {
        error_log('fail to create reviews') . PHP_EOL;
        error_log('debugging error:') . mysqli_error($link) . PHP_EOL;
    }
}

//バリデーションする
global $errors, $review;
$errors = validate($review);
//もしバリデーションERRORが無ければ
if (!count($errors)) {

    global $errors, $review;

    $link = dbConnect();

    createReview($link, $review);

    mysqli_close($link);

    header("Location: index.php");
}

function validate($review)
{
    global $errors, $review;

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
    $errors = [];
    //タイトル
    if (!strlen($review['title'])) {
        //$errorに会社名を表示して新しい配列を格納する
        $errors['title'] = 'タイトルを登録してください。' . PHP_EOL;
    } elseif (strlen($review['title']) > 255) {
        //$errorに255文字以内と表示して新しい配列を格納する
        $errors['title'] =
            'タイトルは255文字以内でよろしく' . PHP_EOL;
    }

    //著者名
    if (!strlen($review['author'])) {
        //$errorに会社名を表示して新しい配列を格納する
        $errors['author'] = '著者名を登録してください。' . PHP_EOL;
    } elseif (strlen($review['author']) > 255) {
        //$errorに255文字以内と表示して新しい配列を格納する
        $errors['author'] =
            '著者名は255文字以内でよろしく' . PHP_EOL;
    }
    if (!in_array($review['status'], ['未読', '読んでる', '読了'])) {
        $errors['status'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }

    // 評価が正しく入力されているかチェック
    if ($review['score'] < 1 || $review['score'] > 5) {
        $errors['score'] = '評価は1〜5の整数を入力してください';
    }

    //感想
    if (!strlen($review['summary'])) {
        //$errorに会社名を表示して新しい配列を格納する
        $errors['summary'] = '感想を登録してください。' . PHP_EOL;
    } elseif (strlen($review['summary']) > 255) {
        //$errorに255文字以内と表示して新しい配列を格納する
        $errors['summary'] =
            '感想は255文字以内でよろしく' . PHP_EOL;
    }
    return  $errors;
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
        header("Location: index.php");
    }
}

include __DIR__ .'/views/new.php';
