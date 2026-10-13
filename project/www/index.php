<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
});

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/../src/routes.php';

$isRouteFound = false;

foreach ($routes as $pattern => $controllerAndAction) {
    if (preg_match($pattern, $route, $matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    http_response_code(404);
    echo 'Страница не найдена!';
    return;
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);