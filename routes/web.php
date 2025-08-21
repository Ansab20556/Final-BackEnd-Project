<?php

use App\Controllers\ProgramController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Core\Router;

$router = new Router();

$router->get('/oraganization-mvc/public/programs', [ProgramController::class, 'index']);
$router->get('/oraganization-mvc/public/programs/create', [ProgramController::class, 'create']);
$router->post('/oraganization-mvc/public/programs', [ProgramController::class, 'store']);
$router->get('/oraganization-mvc/public/programs/{id}/edit', [ProgramController::class, 'edit']);
$router->post('/oraganization-mvc/public/programs/{id}/update', [ProgramController::class, 'update']);
$router->post('/oraganization-mvc/public/programs/{id}/delete', [ProgramController::class, 'delete']);


$router->post('/oraganization-mvc/public/api/login', [AuthController::class, 'login']);


$router->get('/oraganization-mvc/public/users', [UserController::class, 'index']);
$router->get('/oraganization-mvc/public/users/create', [UserController::class, 'create']);
$router->post('/oraganization-mvc/public/users', [UserController::class, 'store']);
$router->get('/oraganization-mvc/public/users/{id}/edit', [UserController::class, 'edit']);
$router->post('/oraganization-mvc/public/users/{id}/update', [UserController::class, 'update']);
$router->post('/oraganization-mvc/public/users/{id}/delete', [UserController::class, 'delete']);



$router->get('/oraganization-mvc/public/api/workfields', [ProgramController::class, 'apiIndex']);
$router->post('/oraganization-mvc/public/api/workfields/{id}/delete', [ProgramController::class, 'apiDelete']);