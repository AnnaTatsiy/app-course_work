<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\car;
use App\Models\_brand;
use App\Models\Client;
use App\Models\repair;
use Illuminate\Http\JsonResponse;

class MalfunctionsController extends Controller
{

    // Запрос 5
    //Фамилия, имя, отчество клиентов, сдавших в ремонт автомобили с указанным типом неисправности?
    public function query05($id_malfunction) : JsonResponse{
        return response()->json(repair::with('client')->where('malfunction_id','=',$id_malfunction)->paginate());
    }
}
