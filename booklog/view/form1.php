<h1 class="h2">
    <a class="text-body text-decoration-none" href="view/index2.php">読書ログ</a>
</h1>
<div class="container">
    <h2 class="h3 text-dark mb4">読書ログの登録</h2>
    <form action="creation.php" method="POST">
        <?php $book = [
            'name' => '',
            'auther' => '',
            'status' => '',
            'score' => '',
            'emotions' => ''
        ]; ?>
        <?php global $book, $errors; ?>
        <?php if (array_key_exists('errors', $GLOBALS) && is_array($errors)) : ?>
            <ul class="text-danger">
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?> </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="form-group">
            <label for="name">書籍名</label>
            <input type="text" name="name" id="name" class="form-control" value=" <?php echo $book['name'] ?>">
        </div>
        <div class="form-group">
            <label for="auther">著者名</label>
            <input type="text" name="auther" id="auther" class="form-control" value="<?php echo $book['auther'] ?>">
        </div>
        <div class="form-group">
            <label>読書状況</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name=" status" id="status1" value="未読" checked>
                    <label class="form-check-label" for="status1">未読</label>
                </div>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name=" status" id="status2" value="読んでる">
                        <label class="form-check-label" for="status2">読んでる</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name=" status" id="status3" value="読了" checked>
                        <label class="form-check-label" for="status3">読了</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="score">評価（5点満点の整数）</label>
                <input type="number" name="score" id="score" class="form-control" value="<?php echo $book['score'] ?>">
            </div>
            <div class="form-group">
                <label for="emotions">感想</label>
                <textarea type="text" name="emotions" id="emotions" class="form-control" rows="10" value="<?php echo ($book['emotions']); ?>"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
    </form>
