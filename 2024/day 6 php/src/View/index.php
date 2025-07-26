<?php

declare(strict_types=1);

use Adventofcode\Day6\utils\Router;

$router = new Router($_SERVER["REQUEST_URI"]);

$router->Get("/day", function () {
    Router::View("day/index");
});

$router->Middleware()->Get("/day/:id", function (array $params) {
    $id = $params[0]->urlValue ?? null;
    Router::View("day/{$id}");
});

$router->Get("/", function () {
    Router::View("Home");
});
