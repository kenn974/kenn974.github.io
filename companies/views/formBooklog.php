<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charaset = "utf-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1">
        <title>読書ログ登録</title>

    </head>

    <body>
        <h1>読書ログ</h1>
        <form action = "creation.php" method = "POST">
            <?php if (is_countable($errors)) : ?>
               <ul>
                  <?php foreach ($errors as $error) : ?>
                     <li><?php echo $error; ?> </li>
                  <?php endforeach; ?>
               </ul>
            <?php endif; ?>

        <div>
            <label for="custom">書籍名</label>
            <input type = "text" name="custom" id="custom">
        </div>
        <div>
            <label for = "auther">著者名</label>
            <input type="text" name="auther" id="auther">
        </div>

     <div>
            <div>
                <div>
                    <input type="radio" name="status1" id="status1" value="未読">
                    <label for="status1">未読</label>
                </div>
                <div>
                    <input type="radio" name="status2" id="status2" value="読んでる">
                    <label for="status2">読んでる</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="status3" id="status3" value="読了">
                    <label for="status3">読了</label>
                </div>
            </div>
        </div>
        <div>
            <label for="score">評価（5点満点の整数）</label>
            <input type="number" name="score" id="score">
        </div>
        <div>
            <label for="emotions">感想</label>
            <textarea type="text" name= "emotions" id="emotions" rows="10"></textarea>
        </div>
        <button type="submit">送信</button>

        </form>
    </body>

</html>
