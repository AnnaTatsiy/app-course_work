<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\repair;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CarsController extends Controller
{
    // получить все записи
    public function cars(): JsonResponse {
        return response()->json(car::with('_brand','color','client')->paginate());
    }

    // Запрос 1
    //Фамилия, имя, отчество и адрес владельца автомобиля с данным номером государственной регистрации
    public function query01($id_car) : JsonResponse{
        return response()->json(car::with('client')->where('id','=',$id_car)->paginate());
    }

    //Запрос 8
    //Необходимо предусмотреть возможность выдачи справки о количестве автомобилей в ремонте на текущий момент
    public function query08() : JsonResponse{
        return response()->json(repair::with('car')
            ->where('is_fixed','=',false)
            ->where('date_of_correction','>', new DateTime())
            ->distinct()
            ->count());
    }

    //Query8() => Db.Repairs.Where(r => r.IsFixed == false).Select(r=>r.Car.Id).Distinct().Count();
}
