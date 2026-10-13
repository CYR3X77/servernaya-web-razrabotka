<?php include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование статьи</h1>

    <?php if ($error !== null): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form action="/article/<?= $article->getId() ?>/edit" method="post">
        <p>
            <label for="name">Название статьи</label><br>
            <input type="text" id="name" name="name" size="60" value="<?= htmlspecialchars($name) ?>">
        </p>
        <p>
            <label for="text">Текст статьи</label><br>
            <textarea id="text" name="text" rows="10" cols="80"><?= htmlspecialchars($text) ?></textarea>
        </p>
        <p>
            <input type="submit" value="Сохранить">
            <a href="/articles/<?= $article->getId() ?>">Отмена</a>
        </p>
    </form>
<?php include __DIR__ . '/../footer.php'; ?>