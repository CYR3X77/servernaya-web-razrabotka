<?php include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование комментария</h1>

    <?php if (!empty($error)): ?>
        <div style="background-color: red; padding: 5px; margin: 15px"><?= $error ?></div>
    <?php endif; ?>

    <form action="/comments/<?= $comment->getId() ?>/edit" method="post">
        <textarea name="text" rows="6" cols="60"><?= htmlspecialchars($_POST['text'] ?? $comment->getText()) ?></textarea>
        <br><br>
        <input type="submit" value="Сохранить">
        <a href="/articles/<?= $comment->getArticleId() ?>#comment<?= $comment->getId() ?>">Отмена</a>
    </form>
<?php include __DIR__ . '/../footer.php'; ?>