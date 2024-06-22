<?php

require_once __DIR__ . '/lib/mysqli.php';

//ヒアドキュメントを書いて、会社情報を登録するSQL文を書く
function createCompany($link, $company){
    $sql = <<<EOT
INSERT INTO companies (
    name,
    establishment_date,
    founder
) VALUES (
    "{$company['name']}",
    "{$company['establishment_date']}",
    "{$company['founder']}"
)
EOT;

    $result = mysqli_query($link, $sql);
     //mysqli_queryが成功した場合と失敗した場合の条件分岐
    if (!$result) {
        error_log('Error: fail to create company');
        error_log('Debugging Error:' . mysqli_error($link));
        //mysqli_error($link)でERRORログを表示している
    }
}

function validate($company)
{
    //error情報を配列として保存!!
    $errors = [];

    //  会社名のバリデーション
    if (!strlen($company['name'])) {
        $errors['name'] = '会社名を入力してください';
    } elseif (strlen($company['name']) > 255) {
        $errors['name'] = '会社名は255文字以内で入力してください';
    }

    //設立日
    //$company['establishment_date']がどういう形式でデータが来ているかのチェック
    //var_dump($company['establishment_date']);
    // 2020-10-8 → 2020 10 8 にしたいので、特定の文字列で分割出来るexplode関数を使う
    //aaa → 分割出来ないのでerorr
    $dates = explode('-', $company['establishment_date']);
    if (!strlen($company['establishment_date'])) {
        $errors['establishment_date'] = '設立日を入力してください';
    } elseif (count($dates) !== 3) {
        $errors['establishment_date'] = '設立日を正しい形式で入力してください';
    } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
        $errors['establishment_date'] = '設立日を正しい日付で入力してください';
    }

    //代表者
    if (!strlen($company['founder'])) {
        $errors['founder'] = '代表者を入力してください';
    } elseif (strlen($company['founder']) > 255) {
        $errors['founder'] = '代表者は255文字以内で入力してください';
    }
    return $errors;
}
//HTTPメソッドがPOSTだったら会社情報を登録する(formから、POSTされた時のみ実行したい)
//動作確認
//var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
];
    //バリデーションする。 バリデーションの結果としてERRORを受け取りたい
    $errors = validate($company);
    //バリデーションerrorが無ければ
    if (!count($errors)) {
    //データベースに接続する
    $link = dbConnect();
    //データベースに会社情報のデータを登録する
    createCompany($link, $company);
    //データベースとの接続を切断する
    mysqli_close($link);
    //リダイレクトの処理
    header("Location: index.php");
    }
}

include 'views/form.php';
