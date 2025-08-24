<?php

use App\Controllers\ProgramController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\OrganizationController;
use App\Controllers\DonationController;
use App\Core\Router;

$router = new Router();

/**
 * ======================
 * Programs Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/programs', [ProgramController::class, 'index']);       // عرض جميع البرامج
$router->get('/oraganization-mvc/public/programs/create', [ProgramController::class, 'create']); // فورم إنشاء برنامج
$router->post('/oraganization-mvc/public/programs', [ProgramController::class, 'store']);       // حفظ برنامج جديد
$router->get('/oraganization-mvc/public/programs/{id}/edit', [ProgramController::class, 'edit']); // فورم تعديل
$router->put('/oraganization-mvc/public/programs/{id}', [ProgramController::class, 'update']);   // تحديث البرنامج
$router->delete('/oraganization-mvc/public/programs/{id}', [ProgramController::class, 'delete']); // حذف برنامج


/**
 * ======================
 * Users Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/users', [UserController::class, 'index']);       // قائمة المستخدمين
$router->get('/oraganization-mvc/public/users/create', [UserController::class, 'create']); // فورم إنشاء
$router->post('/oraganization-mvc/public/users', [UserController::class, 'store']);       // إضافة مستخدم
$router->get('/oraganization-mvc/public/users/{id}/edit', [UserController::class, 'edit']); // فورم تعديل
$router->put('/oraganization-mvc/public/users/{id}', [UserController::class, 'update']);   // تحديث مستخدم
$router->delete('/oraganization-mvc/public/users/{id}', [UserController::class, 'delete']); // حذف مستخدم


/**
 * ======================
 * Organization Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/organization', [OrganizationController::class, 'index']);       // عرض بيانات المنظمة
$router->get('/oraganization-mvc/public/organization/create', [OrganizationController::class, 'create']); // فورم إدخال بيانات
$router->post('/oraganization-mvc/public/organization', [OrganizationController::class, 'store']);       // تخزين بيانات
$router->get('/oraganization-mvc/public/organization/{id}/edit', [OrganizationController::class, 'edit']); // تعديل
$router->put('/oraganization-mvc/public/organization/{id}', [OrganizationController::class, 'update']);   // تحديث
$router->delete('/oraganization-mvc/public/organization/{id}', [OrganizationController::class, 'delete']); // حذف


/**
 * ======================
 * Donations Routes
 * ======================
 */
$router->get('/oraganization-mvc/public/donations', [DonationController::class, 'index']);       // قائمة التبرعات
$router->get('/oraganization-mvc/public/donations/create', [DonationController::class, 'create']); // فورم إنشاء
$router->post('/oraganization-mvc/public/donations', [DonationController::class, 'store']);       // إضافة تبرع
$router->get('/oraganization-mvc/public/donations/{id}/edit', [DonationController::class, 'edit']); // تعديل
$router->put('/oraganization-mvc/public/donations/{id}', [DonationController::class, 'update']);   // تحديث (صح هنا بدون /update)
$router->delete('/oraganization-mvc/public/donations/{id}', [DonationController::class, 'delete']);

/**
 * ======================
 * Auth / API Routes
 * ======================
 */
$router->post('/oraganization-mvc/public/api/login', [AuthController::class, 'login']);

// Workfields API
$router->get('/oraganization-mvc/public/api/workfields', [ProgramController::class, 'apiIndex']);
$router->delete('/oraganization-mvc/public/api/workfields/{id}', [ProgramController::class, 'apiDelete']);

// Uers API
// API routes
$router->get('/oraganization-mvc/public/api/v1/users', [UserController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/users/{id}', [UserController::class, 'apiShow']);
$router->post('/oraganization-mvc/public/api/v1/users', [UserController::class, 'apiStore']);
$router->delete('/oraganization-mvc/public/api/v1/users/{id}', [UserController::class, 'apiDelete']);
$router->put('/oraganization-mvc/public/api/v1/users/{id}', [UserController::class, 'apiUpdate']);
$router->delete('/oraganization-mvc/public/api/v1/users', [UserController::class, 'apiDeleteAll']);

// Programs API
// API routes
$router->get('/oraganization-mvc/public/api/v1/programs', [ProgramController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/programs/{id}', [ProgramController::class, 'apiShow']); // جديد
$router->post('/oraganization-mvc/public/api/v1/programs', [ProgramController::class, 'apiStore']);
$router->put('/oraganization-mvc/public/api/v1/programs/{id}', [ProgramController::class, 'apiUpdate']);
$router->delete('/oraganization-mvc/public/api/v1/programs/{id}', [ProgramController::class, 'apiDelete']);
$router->delete('/oraganization-mvc/public/api/v1/programs', [ProgramController::class, 'apiDeleteAll']); // حذف كل البرامج

// Donations API
$router->get('/oraganization-mvc/public/api/v1/donations', [DonationController::class, 'apiIndex']);
$router->get('/oraganization-mvc/public/api/v1/donations/{id}', [DonationController::class, 'find']); // لو تريد عرض واحد
$router->post('/oraganization-mvc/public/api/v1/donations', [DonationController::class, 'apiStore']);
$router->put('/oraganization-mvc/public/api/v1/donations/{id}', [DonationController::class, 'apiUpdate']); 
$router->delete('/oraganization-mvc/public/api/v1/donations/{id}', [DonationController::class, 'apiDelete']);
$router->delete('/oraganization-mvc/public/api/v1/donations', [DonationController::class, 'apideleteAll']);
