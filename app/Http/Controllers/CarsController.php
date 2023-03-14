<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarsController extends Controller
{
    // получить все записи
    public function cars(): View  {
        $cars = car::with('brand','color','client')->get();
        $owners = Client::with('person')->get();
        return view('cars.index', ['cars' => $cars, 'owners' => $owners, 'selectOwner' => 1]);
    }

    //Запрос 2
    //Марка и год выпуска автомобиля данного владельца
    public function carsSelectByOwner(Request $request) :View {

        $selectOwner = $request->input('owner');

        $result = car::with('brand','color','client')
            ->where('client_id', '=', $selectOwner)
            ->get();

        $owners = Client::with('person')->get();
        return view('cars.index', ['cars' => $result, 'owners' => $owners, 'selectOwner' => $selectOwner ]);
    }



}
