<?php

use App\Controllers\AppController;
use App\Controllers\PromoController;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group("modules", function ($routes) {
    $routes->get("apps", [AppController::class, "apps"]);

    $routes->group("promo", function ($routes) {
        $routes->get("/", [PromoController::class, "index"]);
        $routes->get("create", [PromoController::class, "create"]);
        $routes->post("store", [PromoController::class, "store"]);
        $routes->get("(:segment)/edit", [PromoController::class, "edit/$1"]);
        $routes->put('(:segment)/update', [PromoController::class, 'update/$1']);
        $routes->delete('(:segment)/delete', [PromoController::class, 'delete/$1']);
    });
});