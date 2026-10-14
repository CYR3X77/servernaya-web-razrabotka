<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <p><a href="/article/<?= $article->getId() ?>/edit">Редактировать статью</a></p>

    <hr>
    <?php $comments = $article->getComments(); ?>
    <h2>Комментарии (<?= count($comments) ?>)</h2>

    <?php foreach ($comments as $comment): ?>
        <div id="comment<?= $comment->getId() ?>" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
            <b><?= htmlspecialchars($comment->getAuthor()->getNickname()) ?></b>
            <small><?= $comment->getCreatedAt() ?></small>
            <?php if (!empty($user) && $comment->canBeEditedBy($user)): ?>
                — <a href="/comments/<?= $comment->getId() ?>/edit">Редактировать</a>
            <?php endif; ?>
            <p><?= nl2br(htmlspecialchars($comment->getText())) ?></p>
        </div>
    <?php endforeach; ?>

    <?php if (!empty($user)): ?>
        <h3>Добавить комментарий</h3>
        <?php if (!empty($commentError)): ?>
            <div style="background-color: red; padding: 5px; margin: 15px"><?= $commentError ?></div>
        <?php endif; ?>
        <form action="/articles/<?= $article->getId() ?>/comments" method="post">
            <textarea name="text" rows="5" cols="60"><?= htmlspecialchars($_POST['text'] ?? '') ?></textarea>
            <br><br>
            <input type="submit" value="Отправить">
        </form>
    <?php else: ?>
        <p><a href="/users/login">Войдите</a>, чтобы оставить комментарий.</p>
    <?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>