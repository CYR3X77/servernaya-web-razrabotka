<?php

return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~'   => [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^$~'           => [\MyProject\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^article/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/login$~'    => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logout$~'   => [\MyProject\Controllers\UsersController::class, 'logout'],
    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\CommentsController::class, 'add'],
    '~^comments/(\d+)/edit$~'     => [\MyProject\Controllers\CommentsController::class, 'edit'],
];