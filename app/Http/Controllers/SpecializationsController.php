<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use App\Models\worker;


use Illuminate\Support\Facades\DB;

class SpecializationsController extends Controller
{

    //Запрос 7
    //Количество рабочих каждой специальности на станции
    public function specializations() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View{
        $specializations = DB::select('call count_by_specialization();');
        return view('specializations.index', ['specializations' => $specializations]);
    }
}
