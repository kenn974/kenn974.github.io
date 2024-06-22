    <h1 class="h2, text-dark, mb-4, mt-4">会社情報の一覧</h1>
    <a href="new.php" class="btn btn-primary, mb-4, ">会社情報を登録する</a>
    <main>
        <?php if (is_countable($companies) > 0) : ?>
            <?php foreach ($companies as $company) : ?>
                <section>
                    <div>
                        <h2>
                            <?php echo escape($company['name']); ?>
                        </h2>
                        <div>
                            創業 : <?php echo escape($company['establishment_date']); ?>年&nbsp; | &nbsp;
                            代表 : <?php echo escape($company['founder']); ?>
                    </div>
                    </div>
                </section>

            <?php endforeach; ?>

        <?php else : ?>

            <p>会社情報が登録されていません</p>

        <?php endif; ?>

    </main>
