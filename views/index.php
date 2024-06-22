<h1 class="h2 text-dark mt-4 mb-4">読書ログの一覧</h1>
<a href="new.php" class="btn btn-primary mb-4">読書ログを登録する</a>
    <main>
        <?php if (is_countable($reviews) > 0) : ?>
            <?php foreach ($reviews as $review) : ?>
                <section class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-3"><?php echo escape($review['title']); ?></h2>
                        <div>
                            <?php echo escape($review['author']); ?>&nbsp;/&nbsp;
                            <?php echo escape($review['status']); ?>&nbsp;/&nbsp;
                            <?php echo escape($review['score']); ?>点
                        </div>
                        <p>
                            <?php echo nl2br(escape($review['summary']), false); ?>
                        </p>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php else : ?>
            <p>まだ読書ログが登録されていません。</p>
        <?php endif; ?>
    </main>
