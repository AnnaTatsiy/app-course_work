<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\RepairsController;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\MalfunctionsController;
use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

#region Таблицы

//Таблица клиенты
Route::get('/clients/all', [ClientsController::class, 'clients']);

//Таблица рабочие
Route::get('/workers/all', [WorkersController::class, 'workers']);

//Таблица авто
Route::get('/cars/all', [CarsController::class, 'cars']);

//Таблица ремонты
Route::get('/repairs/all', [RepairsController::class, 'repairs']);

//Запрос 1
Route::get('/cars/owner-by-state-number/{id_car}', [CarsController::class, 'query01']);

//Запрос 2
Route::get('/clients/select-car-by-owner/{id_owner}', [ClientsController::class, 'query02']);

//Запрос 3
Route::get('/clients/select-malfunctions-by-owner/{id_owner}', [ClientsController::class, 'query03']);

//Запрос 4
Route::get('/clients/select-worker-by-malfunction-client/{id_client}/{id_malfunction}', [ClientsController::class, 'query04']);

//Запрос 5
Route::get('/malfunctions/select-clients-by-malfunctions/{id_malfunction}', [MalfunctionsController::class, 'query05']);

//Запрос 6 //car-brand/select-malfunction-by-car-brand/1
Route::get('/car-brand/select-malfunction-by-car-brand/{id_car_brand}', [BrandsController::class, 'query06']);

//Запрос 7
Route::get('/workers/select-count-by-specialization', [WorkersController::class, 'query07']);

//Запрос 8
Route::get('/cars/count-cars-at-the-moment', [CarsController::class, 'query08']);
