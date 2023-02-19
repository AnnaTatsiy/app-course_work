<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\_brand;
use App\Models\Client;
use App\Models\repair;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    // получить все записи
    public function clients(): JsonResponse {
        return response()->json(Client::with('person')->paginate());
    }

    //Запрос 2
    //Марка и год выпуска автомобиля данного владельца
    public function query02($id_owner) : JsonResponse{
        return response()->json(car::with('brand')->where('client_id', '=',$id_owner)->paginate());
    }

    //Запрос 3
    //Перечень устраненных неисправностей в автомобиле данного владельца
    public function query03($id_owner) : JsonResponse{
        return response()->json(repair::with('malfunction')->where('client_id', '=',$id_owner)->where('is_fixed','=',1)->paginate());
    }

    //Запрос 4
    //Фамилия, имя, отчество работника станции, устранявшего данную неисправность в автомобиле данного клиента, и время ее устранения
    public function query04($id_client,$id_malfunction) : JsonResponse{
        return response()->json(repair::with('worker')->where('client_id', '=',$id_client)->where('malfunction_id','=',$id_malfunction)->paginate());
    }
}
