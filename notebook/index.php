<?php



require __DIR__ . '/config.php';
require __DIR__ . '/menu.php';
require __DIR__ . '/viewer.php';
require __DIR__ . '/add.php';
require __DIR__ . '/edit.php';
require __DIR__ . '/delete.php';

$action = $_GET['action'] ?? 'view';
if (!in_array($action, ['view', 'add', 'edit', 'delete'], true)) {
    $action = 'view';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка контактов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?= renderMenu(); ?>

<main>
<?php
switch ($action) {
    case 'add':
        echo renderAdd($pdo);
        break;

    case 'edit':
        echo renderEdit($pdo);
        break;

    case 'delete':
        echo renderDelete($pdo);
        break;

    case 'view':
    default:
        $sort = $_GET['sort'] ?? 'order';
        $page = (int)($_GET['page'] ?? 1);
        echo renderViewer($pdo, $sort, $page);
        break;
}
?>
</main>

</body>
</html>
