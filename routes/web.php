<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\RepairsController;
use App\Http\Controllers\SpecializationsController;
use App\Http\Controllers\MalfunctionsController;
use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;


//Главная страница
Route::get('/', [HomeController::class, 'index']);

//О разработчике
Route::get('/about', [HomeController::class, 'about']);

#region Таблицы

//Таблица клиенты
Route::get('/clients/all', [ClientsController::class, 'clients']);

//Таблица рабочие
Route::get('/workers/all', [WorkersController::class, 'workers']);

//Таблица авто
Route::get('/cars/all', [CarsController::class, 'cars']);

//Таблица ремонты
Route::get('/repairs/all', [RepairsController::class, 'repairs']);

//Архив
Route::get('/repairs/archive-all', [RepairsController::class, 'archive']);

//Таблица неисправности
Route::get('/malfunctions/all', [MalfunctionsController::class, 'malfunctions']);

#region Запросы

//Запрос 1
Route::post('/clients/select-client-by-state-number', [ClientsController::class, 'selectClientByStateNumber']);

//Запрос 2
Route::post('/cars/select-car-by-owner', [CarsController::class, 'carsSelectByOwner']);

//Запрос 3
Route::post('/malfunctions/select-malfunctions-by-owner', [MalfunctionsController::class, 'malfunctionsSelectByOwner']);

//Запрос 4
Route::post('/workers/select-worker-by-malfunction-and-owner', [WorkersController::class, 'workerSelectByMalfunctionsAndOwner']);

//Запрос 5
Route::post('/clients/select-client-by-malfunction', [ClientsController::class, 'selectClientByMalfunction']);

//Запрос 6
Route::post('/malfunctions/select-malfunctions-by-brand', [MalfunctionsController::class, 'commonMalfunctionByBrandId']);

//Запрос 7
Route::get('/specializations/select-count-by-specialization', [SpecializationsController::class, 'specializations']);

//Запрос 8
Route::get('/cars/count-cars-at-the-moment', [CarsController::class, 'query08']);

//Запрос 9
Route::get('/workers/select-count-free-workers', [SpecializationsController::class, 'query09']);

//Запрос 10
Route::post('/home/show-report', [HomeController::class, 'showReport']);


// добавляет клиента в таблицу, используйте форму с валидацией
Route::get('/client/create', [ ClientsController::class, 'createForm' ]);
Route::post('/client/add', [ ClientsController::class, 'add' ]);

//редактирует клиента
Route::get('/client/edit-form/{id}', [ ClientsController::class, 'editForm' ]);
Route::post('/client/edit', [ ClientsController::class, 'edit' ]);


// добавляет рабочего в таблицу, используйте форму с валидацией
Route::get('/worker/create', [ WorkersController::class, 'createForm' ]);
Route::post('/worker/add', [ WorkersController::class, 'add' ]);

//редактирует рабочего
Route::get('/worker/edit-form/{id}', [ WorkersController::class, 'editForm' ]);
Route::post('/worker/edit', [ WorkersController::class, 'edit' ]);

//"мягкое" удаление рабочего
Route::get('/worker/delete/{id}', [ WorkersController::class, 'delete' ]);


// добавляет авто в таблицу, используйте форму с валидацией
Route::get('/car/create', [ CarsController::class, 'createForm' ]);
Route::post('/car/add', [ CarsController::class, 'add' ]);

//редактирует авто
Route::get('/car/edit-form/{id}', [ CarsController::class, 'editForm' ]);
Route::post('/car/edit', [ CarsController::class, 'edit' ]);


// добавляет ремонт в таблицу, используйте форму с валидацией
Route::get('/repair/create', [ RepairsController::class, 'createForm' ]);
Route::post('/repair/add', [ RepairsController::class, 'add' ]);

//редактирует ремонт
Route::get('/repair/edit-form/{id}', [ RepairsController::class, 'editForm' ]);
Route::post('/repair/edit', [ RepairsController::class, 'edit' ]);

//"мягкое" удаление ремонта
Route::get('/repair/delete/{id}', [ RepairsController::class, 'delete' ]);

//генерация расписки
Route::get('/repair/generate-receipt/{id}', [ RepairsController::class, 'generateReceipt' ]);

//генерация счета
Route::get('/repair/generate-account/{id}', [ RepairsController::class, 'generateAccount' ]);

Route::get('/report-about-repairs', [HomeController::class, 'showParamForReportRepairs']);
Route::post('/home/report-about-repairs', [HomeController::class, 'showReportAboutRepairs']);
