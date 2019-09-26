<?php

use Illuminate\Routing\Router;
use Mtc\CurrentlyViewing\Http\Controllers\CurrentlyViewingController;

/** @var Router $router */

$router->post('/api/currently-viewing-page', [CurrentlyViewingController::class, 'index']);
