<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\car;
use App\Models\brand;
use App\Models\Client;
use App\Models\repair;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
        //Запрос 6
        //Самая распространенная неисправность в автомобилях указанной марки
        public function query06($id_brand) : JsonResponse{
            return response()->json(DB::select("call malfunction_by_brand($id_brand);"));
        }
}
