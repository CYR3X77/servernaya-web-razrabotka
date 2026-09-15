<?php

function renderAdd(PDO $pdo): string
{
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
        $stmt = $pdo->prepare(
            'INSERT INTO contacts (surname, name, lastname, gender, birthdate, phone, location, email, comment)
             VALUES (:surname, :name, :lastname, :gender, :birthdate, :phone, :location, :email, :comment)'
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
        ]);

        $message = $ok
            ? '<p class="success">Запись добавлена</p>'
            : '<p class="error">Ошибка: запись не добавлена</p>';
    }

    $row = [
        'surname'  => $_POST['surname'] ?? '',
        'name'     => $_POST['name'] ?? '',
        'lastname' => $_POST['lastname'] ?? '',
        'gender'   => $_POST['gender'] ?? '',
        'date'     => $_POST['date'] ?? '',
        'phone'    => $_POST['phone'] ?? '',
        'location' => $_POST['location'] ?? '',
        'email'    => $_POST['email'] ?? '',
        'comment'  => $_POST['comment'] ?? '',
    ];
    $button = 'Добавить';

    ob_start();
    include __DIR__ . '/form_template.php';
    $form = ob_get_clean();

    return $message . $form;
}
