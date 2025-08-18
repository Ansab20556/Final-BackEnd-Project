<?php

use App\Controllers\ProgramController;
use App\Core\Router;


$router=new Router();
// /oraganization-mvc/public/

$router->get('/oraganization-mvc/public/programs',[ProgramController::class,'index']);

$router->get('/oraganization-mvc/public/programs/create',[ProgramController::class,'create']);

$router->post('/oraganization-mvc/public/programs',[ProgramController::class,'store']);
