<?php
require_once __DIR__ . '/../library/mysql.php';

function createBook($link, $book)
{
    $sql = <<< EOT
    INSERT INTO book_table(
       name,
       auther,
       situation,
       score,
       emotions
    )  VALUES (
       "{$book['name']}",
       "{$book['auther']}",
       "{$book['situation']}",
       "{$book['score']}",
       "{$book['emotions']}"
)
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create book');
        error_log('DebuggingError:' . mysqli_error($link));
    }
}

function redirectToIndex(){
header("Location: index2.php");
}

//バリデーションする
//書籍名が正しく入力されているかチェック
function validate($book)
{
    $errors = [];

    if (!strlen($book['name'])) {
        $errors['name'] = '書籍名を入力してください';
    } elseif (strlen($book['name']) > 255) {
        $errors['name'] = '書籍名は255文字以内で入力してください';
    }

    //著者名が正しく入力されているかチェック
    if (!strlen($book['auther'])) {
        $errors['auther'] = '著者名を入力してください';
    } elseif (strlen($book['auther']) > 255) {
        $errors['auther'] = '著者名は255文字以内で入力してください';
    }

    //読書状況が正しく入力されているかチェック
    if (!in_array($book['situation'], ['未読', '読んでる', '読了'])) {
        $errors['situation'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }

    //評価が正しく入力されているかチェック
    if ($book['score'] < 1 || $book['score'] > 5) {
        $errors['score'] = '評価は1~5の整数を入力してください';
    }

    //感想が正しく入力されているかチェック
    if (!strlen($book['emotions'])) {
        $errors['emotions'] = '感想を入力してください';
    } elseif (strlen($book['emotions']) > 255) {
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

        $book = [
            'name' => $_POST['name'],
            'auther' => $_POST['auther'],
            'situation' => $situation,
            'score' => $_POST['score'],
            'emotions' => $_POST['emotions'],
        ];

        $errors = validate($book);
        if (!count($errors)) {
redirectToIndex();
$link = dbConnect();
createBook($link, $book);
mysqli_close($link);
header("Location: index2.php");
        }
    }
}


function someFunction()
{
    global $errors;
    echo $errors;
    header("Location: index2.php");

someFunction();
}
 $fileName = 'index2.php';

 if (file_exists($fileName)) {
    include $fileName;
 } else {
    echo "ファイルが見つかりませんぜ!!";
 }

 include 'form1.php';
