<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\car;
use App\Models\brand;
use App\Models\Client;
use App\Models\repair;
use Illuminate\Http\JsonResponse;

class BrandsController extends Controller
{
        //Запрос 6
        //Самая распространенная неисправность в автомобилях указанной марки
        public function query06($id_brand) : JsonResponse{

            //ремонты заданной марки
            $repairs =  repair::with('car')->get();

            //ремонты заданной марки
            $repairs = $repairs->where(fn($r) => $r->car->brand_id == $id_brand);

            $group = $repairs->count(fn($r) => $r->malfunction_id);

            //словарь частоты вхождения
            //$groups = $repairs->groupBy('malfunction_id');

            /*
                       $countCollection = $repairs->);
                       /*
                                   //находим максимальную частоту вхождения
                                   $max = $groups->max($countCollection);

                                   //выбираем все записи с максимальной частотой вхождения
                                   $maxCollection = $groups->where(fn($key,$value) => $value->count() == $max);

                                   //выбираем наименования неисправностей
                                   $key = $maxCollection->map(fn($key,$value) => $key); */

            return response()->json($group);
        }
}
