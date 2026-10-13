<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <?php if ($author !== null): ?>
        <p>Автор: <?= $author->getNickname() ?></p>
    <?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>