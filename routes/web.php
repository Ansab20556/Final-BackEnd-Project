<?php

use App\Controllers\ProgramController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\OrganizationController;
use App\Controllers\DonationController;
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


$router->get('/oraganization-mvc/public/organization', [OrganizationController::class, 'index']);
$router->get('/oraganization-mvc/public/organization/create', [OrganizationController::class, 'create']);
$router->post('/oraganization-mvc/public/organization', [OrganizationController::class, 'store']);
$router->get('/oraganization-mvc/public/organization/{id}/edit', [OrganizationController::class, 'edit']);
$router->post('/oraganization-mvc/public/organization/{id}/update', [OrganizationController::class, 'update']);
$router->post('/oraganization-mvc/public/organization/{id}/delete', [OrganizationController::class, 'delete']);


$router->get('/oraganization-mvc/public/donations', [DonationController::class, 'index']);
$router->get('/oraganization-mvc/public/donations/create', [DonationController::class, 'create']);
$router->post('/oraganization-mvc/public/donations', [DonationController::class, 'store']);
$router->get('/oraganization-mvc/public/donations/{id}/edit', [DonationController::class, 'edit']);
$router->post('/oraganization-mvc/public/donations/{id}/update', [DonationController::class, 'update']);
$router->post('/oraganization-mvc/public/donations/{id}/delete', [DonationController::class, 'delete']);