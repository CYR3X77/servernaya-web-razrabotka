<?php

$DB_FILE = __DIR__ . '/data/contacts.sqlite';

$isNewDb = !file_exists($DB_FILE);

if ($isNewDb && !is_dir(dirname($DB_FILE))) {
    mkdir(dirname($DB_FILE), 0777, true);
}

try {
    $pdo = new PDO(
        "sqlite:{$DB_FILE}",
        null,
        null,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    $pdo->exec('PRAGMA foreign_keys = ON');

    if ($isNewDb) {
        $pdo->exec(file_get_contents(__DIR__ . '/schema_sqlite.sql'));
    }
} catch (PDOException $e) {
    die('Ошибка подключения к базе данных: ' . htmlspecialchars($e->getMessage()));
}