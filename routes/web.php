<?php

use App\Controllers\ProgramController;
use App\Core\Router;

$router = new Router();

$router->get('/oraganization-mvc/public/programs', [ProgramController::class, 'index']);
$router->get('/oraganization-mvc/public/programs/create', [ProgramController::class, 'create']);
$router->post('/oraganization-mvc/public/programs', [ProgramController::class, 'store']);

$router->get('/oraganization-mvc/public/programs/{id}/edit', [ProgramController::class, 'edit']);
$router->post('/oraganization-mvc/public/programs/{id}/update', [ProgramController::class, 'update']);
$router->post('/oraganization-mvc/public/programs/{id}/delete', [ProgramController::class, 'delete']);
