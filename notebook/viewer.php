<?php
/**
 * Формирует HTML-таблицу с записями и ссылки пагинации.
 *
 * @param PDO    $pdo   подключение к БД
 * @param string $sort  тип сортировки: order | surname | date
 * @param int    $page  номер страницы пагинации (с 1)
 */
function renderViewer(PDO $pdo, string $sort, int $page): string
{
    $perPage = 10;

    $allowedSort = [
        'order'   => 'id ASC',
        'surname' => 'surname ASC, name ASC',
        'date'    => 'birthdate ASC',
    ];
    $orderBy = $allowedSort[$sort] ?? $allowedSort['order'];

    $total = (int)$pdo->query('SELECT COUNT(*) AS cnt FROM contacts')->fetch()['cnt'];
    $pagesTotal = max(1, (int)ceil($total / $perPage));
    $page = max(1, min($page, $pagesTotal));
    $offset = ($page - 1) * $perPage;

    $stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY {$orderBy} LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    if (empty($rows)) {
        return '<p>Записная книжка пуста</p>';
    }

    $html = '<table>';
    $html .= '<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Пол</th>'
        . '<th>Дата рождения</th><th>Телефон</th><th>Адрес</th><th>Email</th><th>Комментарий</th></tr>';

    foreach ($rows as $r) {
        $html .= '<tr>'
            . '<td>' . htmlspecialchars($r['surname']) . '</td>'
            . '<td>' . htmlspecialchars($r['name']) . '</td>'
            . '<td>' . htmlspecialchars($r['lastname'] ?? '') . '</td>'
            . '<td>' . htmlspecialchars($r['gender']) . '</td>'
            . '<td>' . htmlspecialchars($r['birthdate'] ?? '') . '</td>'
            . '<td>' . htmlspecialchars($r['phone'] ?? '') . '</td>'
            . '<td>' . htmlspecialchars($r['location'] ?? '') . '</td>'
            . '<td>' . htmlspecialchars($r['email'] ?? '') . '</td>'
            . '<td>' . htmlspecialchars($r['comment'] ?? '') . '</td>'
            . '</tr>';
    }
    $html .= '</table>';

    if ($pagesTotal > 1) {
        $html .= '<div class="pagination">';
        for ($p = 1; $p <= $pagesTotal; $p++) {
            $class = ($p === $page) ? ' class="select"' : '';
            $html .= "<a href=\"index.php?action=view&sort={$sort}&page={$p}\"{$class}>{$p}</a> ";
        }
        $html .= '</div>';
    }

    return $html;
}
