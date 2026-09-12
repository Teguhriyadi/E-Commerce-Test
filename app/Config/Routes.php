<?php

use App\Controllers\AppController;
use App\Controllers\BarangController;
use App\Controllers\PengaturanPromoController;
use App\Controllers\PenjualanController;
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

    $routes->group("barang", function ($routes) {
        $routes->get("/", [BarangController::class, "index"]);
        $routes->get("create", [BarangController::class, "create"]);
        $routes->post("store", [BarangController::class, "store"]);
        $routes->get("(:segment)/edit", [BarangController::class, "edit/$1"]);
        $routes->put('(:segment)/update', [BarangController::class, 'update/$1']);
        $routes->delete('(:segment)/delete', [BarangController::class, 'delete/$1']);
    });

    $routes->group("pengaturan-promo", function ($routes) {
        $routes->get("/", [PengaturanPromoController::class, "index"]);
        $routes->get("create", [PengaturanPromoController::class, "create"]);
        $routes->post("store", [PengaturanPromoController::class, "store"]);
        $routes->get("(:segment)/detail", [PengaturanPromoController::class, "detail/$1"]);
        $routes->get("(:segment)/edit", [PengaturanPromoController::class, "edit/$1"]);
        $routes->put('(:segment)/update', [PengaturanPromoController::class, 'update/$1']);
        $routes->delete('(:segment)/delete', [PengaturanPromoController::class, 'delete/$1']);
    });

    $routes->group("penjualan", function ($routes) {
        $routes->get("/", [PenjualanController::class, "index"]);
        $routes->post("store", [PenjualanController::class, "store"]);
        $routes->delete('(:segment)/delete', [PenjualanController::class, 'delete/$1']);
        $routes->get("clear", [PenjualanController::class, "clear"]);
    });
});