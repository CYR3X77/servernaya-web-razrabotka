<?php

function renderMenu(): string
{
    $action = $_GET['action'] ?? 'view';

    $items = [
        'view'   => 'Просмотр',
        'add'    => 'Добавление записи',
        'edit'   => 'Редактирование записи',
        'delete' => 'Удаление записи',
    ];

    if (!array_key_exists($action, $items)) {
        $action = 'view';
    }

    $html = '<header>';
    foreach ($items as $key => $label) {
        $class = ($action === $key) ? ' class="active"' : '';
        $html .= "<a href=\"index.php?action={$key}\"{$class}>{$label}</a>";
    }
    $html .= '</header>';

    
    if ($action === 'view') {
        $sort = $_GET['sort'] ?? 'order';
        $sorts = [
            'order'   => 'По порядку добавления',
            'surname' => 'По фамилии',
            'date'    => 'По дате рождения',
        ];
        if (!array_key_exists($sort, $sorts)) {
            $sort = 'order';
        }

        $html .= '<div class="submenu">';
        foreach ($sorts as $key => $label) {
            $class = ($sort === $key) ? ' class="select"' : '';
            $html .= "<a href=\"index.php?action=view&sort={$key}&page=1\"{$class}>{$label}</a>";
        }
        $html .= '</div>';
    }

    return $html;
}
