<?php

$row = $row ?? [];
$get = static fn(string $key) => htmlspecialchars($row[$key] ?? '');
?>
<form name="form_add" method="post">
    <?php if (!empty($row['id'])): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$row['id']); ?>">
    <?php endif; ?>
    <div class="column">
        <div class="add">
            <label>Фамилия</label>
            <input type="text" name="surname" placeholder="Фамилия" value="<?= $get('surname'); ?>">
        </div>
        <div class="add">
            <label>Имя</label>
            <input type="text" name="name" placeholder="Имя" value="<?= $get('name'); ?>">
        </div>
        <div class="add">
            <label>Отчество</label>
            <input type="text" name="lastname" placeholder="Отчество" value="<?= $get('lastname'); ?>">
        </div>
        <div class="add">
            <label>Пол</label>
            <select name="gender">
                <option value="мужской" <?= ($row['gender'] ?? '') === 'мужской' ? 'selected' : ''; ?>>мужской</option>
                <option value="женский" <?= ($row['gender'] ?? '') === 'женский' ? 'selected' : ''; ?>>женский</option>
            </select>
        </div>
        <div class="add">
            <label>Дата рождения</label>
            <input type="date" name="date" value="<?= $get('date'); ?>">
        </div>
        <div class="add">
            <label>Телефон</label>
            <input type="text" name="phone" placeholder="Телефон" value="<?= $get('phone'); ?>">
        </div>
        <div class="add">
            <label>Адрес</label>
            <input type="text" name="location" placeholder="Адрес" value="<?= $get('location'); ?>">
        </div>
        <div class="add">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="<?= $get('email'); ?>">
        </div>
        <div class="add">
            <label>Комментарий</label>
            <textarea name="comment" placeholder="Краткий комментарий"><?= $get('comment'); ?></textarea>
        </div>

        <button type="submit" value="<?= htmlspecialchars($button ?? 'Сохранить'); ?>" name="button" class="form-btn"><?= htmlspecialchars($button ?? 'Сохранить'); ?></button>
    </div>
</form>
