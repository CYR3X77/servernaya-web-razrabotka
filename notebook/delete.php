<?php
function renderDelete(PDO $pdo): string
{
    $message = '';

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        $stmt = $pdo->prepare('SELECT surname FROM contacts WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            $del = $pdo->prepare('DELETE FROM contacts WHERE id = :id');
            $del->execute([':id' => $id]);
            $message = '<p class="success">Запись с фамилией ' . htmlspecialchars($row['surname']) . ' удалена</p>';
        }
    }

    $list = $pdo->query('SELECT id, surname, name, lastname FROM contacts ORDER BY surname, name')->fetchAll();

    if (empty($list)) {
        return $message . '<p>Записная книжка пуста</p>';
    }

    $html = '<ul style="list-style:none; padding:0;">';
    foreach ($list as $item) {
        $initials = mb_substr($item['name'], 0, 1) . '.'
            . (!empty($item['lastname']) ? mb_substr($item['lastname'], 0, 1) . '.' : '');
        $html .= '<li style="margin:8px 0;"><a href="index.php?action=delete&id=' . $item['id'] . '">'
            . htmlspecialchars($item['surname'] . ' ' . $initials) . '</a></li>';
    }
    $html .= '</ul>';

    return $message . $html;
}
