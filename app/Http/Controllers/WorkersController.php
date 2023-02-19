<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\specialization;
use Illuminate\Http\JsonResponse;
use App\Models\worker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkersController extends Controller
{
    // получить все записи
    public function workers(): JsonResponse {
        return response()->json(Worker::with('person','specialization')->paginate());
    }

    //Запрос 7
    //Количество рабочих каждой специальности на станции
    public function query07() : JsonResponse{
        return response()->json(DB::select('call count_by_specialization();'));
    }
}
