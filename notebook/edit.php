<?php

function renderEdit(PDO $pdo): string
{
    $message = '';

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare(
            'UPDATE contacts SET
                surname = :surname, name = :name, lastname = :lastname, gender = :gender,
                birthdate = :birthdate, phone = :phone, location = :location, email = :email, comment = :comment
             WHERE id = :id'
        );

        $ok = $stmt->execute([
            ':surname'   => trim($_POST['surname'] ?? ''),
            ':name'      => trim($_POST['name'] ?? ''),
            ':lastname'  => trim($_POST['lastname'] ?? ''),
            ':gender'    => $_POST['gender'] ?? '',
            ':birthdate' => !empty($_POST['date']) ? $_POST['date'] : null,
            ':phone'     => trim($_POST['phone'] ?? ''),
            ':location'  => trim($_POST['location'] ?? ''),
            ':email'     => trim($_POST['email'] ?? ''),
            ':comment'   => trim($_POST['comment'] ?? ''),
            ':id'        => (int)$_POST['id'],
        ]);

        $message = $ok
            ? '<p class="success">Запись обновлена</p>'
            : '<p class="error">Ошибка: запись не обновлена</p>';
    }

    $list = $pdo->query('SELECT id, surname, name FROM contacts ORDER BY surname, name')->fetchAll();

    if (empty($list)) {
        return '<p>Записная книжка пуста - нечего редактировать</p>';
    }

    
    if (!empty($_POST['id'])) {
        $currentId = (int)$_POST['id'];
    } elseif (isset($_GET['id'])) {
        $currentId = (int)$_GET['id'];
    } else {
        $currentId = (int)$list[0]['id'];
    }

    $html = '<div class="div-edit">';
    foreach ($list as $item) {
        $class = ((int)$item['id'] === $currentId) ? ' class="currentRow"' : '';
        $html .= "<div{$class}><a href=\"index.php?action=edit&id={$item['id']}\">"
            . htmlspecialchars($item['surname'] . ' ' . $item['name']) . '</a></div>';
    }
    $html .= '</div>';

    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = :id');
    $stmt->execute([':id' => $currentId]);
    $dbRow = $stmt->fetch();

    if (!$dbRow) {
        return $message . $html . '<p class="error">Запись не найдена</p>';
    }

    $row = [
        'id'       => $dbRow['id'],
        'surname'  => $dbRow['surname'],
        'name'     => $dbRow['name'],
        'lastname' => $dbRow['lastname'],
        'gender'   => $dbRow['gender'],
        'date'     => $dbRow['birthdate'],
        'phone'    => $dbRow['phone'],
        'location' => $dbRow['location'],
        'email'    => $dbRow['email'],
        'comment'  => $dbRow['comment'],
    ];
    $button = 'Сохранить';

    ob_start();
    include __DIR__ . '/form_template.php';
    $form = ob_get_clean();

    return $message . $html . $form;
}
