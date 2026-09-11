<?php

use App\Controllers\AppController;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group("modules", function ($routes) {
    $routes->get("apps", [AppController::class, "apps"]);
});