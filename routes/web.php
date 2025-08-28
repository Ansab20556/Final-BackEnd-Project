<?php

use App\Controllers\ProgramController;
use App\Controllers\UserController;
use App\Controllers\OrganizationController;
use App\Controllers\DonationController;
use App\Controllers\MessageController;
use App\Core\Router;

$router = new Router();

/**
 * ======================
 * Programs Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/programs', [ProgramController::class, 'index']); 
$router->get('/oraganization-mvc/public/programs/create', [ProgramController::class, 'create']); 
$router->post('/oraganization-mvc/public/programs', [ProgramController::class, 'store']); 
$router->get('/oraganization-mvc/public/programs/{id}/edit', [ProgramController::class, 'edit']); 
$router->put('/oraganization-mvc/public/programs/{id}', [ProgramController::class, 'update']); 
$router->delete('/oraganization-mvc/public/programs/{id}', [ProgramController::class, 'delete']); 

/**
 * ======================
 * Users Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/users', [UserController::class, 'index']); 
$router->get('/oraganization-mvc/public/users/create', [UserController::class, 'create']); 
$router->post('/oraganization-mvc/public/users', [UserController::class, 'store']); 
$router->get('/oraganization-mvc/public/users/{id}/edit', [UserController::class, 'edit']); 
$router->put('/oraganization-mvc/public/users/{id}', [UserController::class, 'update']); 
$router->delete('/oraganization-mvc/public/users/{id}', [UserController::class, 'delete']); 

/**
 * ======================
 * Organization Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/organization', [OrganizationController::class, 'index']); 
$router->get('/oraganization-mvc/public/organization/create', [OrganizationController::class, 'create']); 
$router->post('/oraganization-mvc/public/organization', [OrganizationController::class, 'store']); 
$router->get('/oraganization-mvc/public/organization/{id}/edit', [OrganizationController::class, 'edit']); 
$router->put('/oraganization-mvc/public/organization/{id}', [OrganizationController::class, 'update']); 
$router->delete('/oraganization-mvc/public/organization/{id}', [OrganizationController::class, 'delete']); 

/**
 * ======================
 * Donations Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/donations', [DonationController::class, 'index']); 
$router->get('/oraganization-mvc/public/donations/create', [DonationController::class, 'create']); 
$router->post('/oraganization-mvc/public/donations', [DonationController::class, 'store']); 
$router->get('/oraganization-mvc/public/donations/{id}/edit', [DonationController::class, 'edit']); 
$router->put('/oraganization-mvc/public/donations/{id}', [DonationController::class, 'update']); 
$router->delete('/oraganization-mvc/public/donations/{id}', [DonationController::class, 'delete']); 

/**
 * ======================
 * API Routes
 * ======================
 */

/* Users API */
$router->get('/oraganization-mvc/public/api/v1/users', [UserController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/users/{id}', [UserController::class, 'apiShow']);
$router->post('/oraganization-mvc/public/api/v1/users', [UserController::class, 'apiStore']);
$router->put('/oraganization-mvc/public/api/v1/users/{id}', [UserController::class, 'apiUpdate']);
$router->delete('/oraganization-mvc/public/api/v1/users/{id}', [UserController::class, 'apiDelete']);
$router->delete('/oraganization-mvc/public/api/v1/users', [UserController::class, 'apiDeleteAll']);

/* Programs API */
$router->get('/oraganization-mvc/public/api/v1/programs', [ProgramController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/programs/{id}', [ProgramController::class, 'apiShow']);
$router->post('/oraganization-mvc/public/api/v1/programs', [ProgramController::class, 'apiStore']);
$router->put('/oraganization-mvc/public/api/v1/programs/{id}', [ProgramController::class, 'apiUpdate']);
$router->delete('/oraganization-mvc/public/api/v1/programs/{id}', [ProgramController::class, 'apiDelete']);
$router->delete('/oraganization-mvc/public/api/v1/programs', [ProgramController::class, 'apiDeleteAll']);

/* Donations API */
$router->get('/oraganization-mvc/public/api/v1/donations', [DonationController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/donations/{id}', [DonationController::class, 'apiShow']);
$router->post('/oraganization-mvc/public/api/v1/donations', [DonationController::class, 'apiStore']);
$router->put('/oraganization-mvc/public/api/v1/donations/{id}', [DonationController::class, 'apiUpdate']);
$router->delete('/oraganization-mvc/public/api/v1/donations/{id}', [DonationController::class, 'apiDelete']);
$router->delete('/oraganization-mvc/public/api/v1/donations', [DonationController::class, 'apiDeleteAll']);

/* Messages API */
$router->get('/oraganization-mvc/public/api/v1/messages', [MessageController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/messages/{id}', [MessageController::class, 'apiShow']);
$router->post('/oraganization-mvc/public/api/v1/messages', [MessageController::class, 'apiStore']);
$router->put('/oraganization-mvc/public/api/v1/messages/{id}', [MessageController::class, 'apiUpdate']);
$router->delete('/oraganization-mvc/public/api/v1/messages/{id}', [MessageController::class, 'apiDelete']);
$router->delete('/oraganization-mvc/public/api/v1/messages', [MessageController::class, 'apiDeleteAll']);
$router->put('/oraganization-mvc/public/api/v1/messages/mark-read', [MessageController::class, 'apiMarkRead']);

/* Login API */
$router->post('/oraganization-mvc/public/api/v1/login', [UserController::class, 'apiLogin']);
$router->post('/oraganization-mvc/public/api/v1/logout', [UserController::class, 'apiLogout']);
