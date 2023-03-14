<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\_brand;
use App\Models\Client;
use App\Models\malfunction;
use App\Models\repair;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientsController extends Controller
{
    // получить все записи
    public function clients(): View {

        $clients = Client::with('person')->get();
        $cars = car::all();
        $malfunctions = malfunction::all();

        return view('clients.index',
            ['clients' => $clients, 'cars' => $cars, 'malfunctions' => $malfunctions, 'selectStateNumber' => 1, 'selectMalfunction' => 1]);
    }

    // Запрос 1
    //владелец автомобиля с данным номером государственной регистрации
    public function selectClientByStateNumber(Request $request) : View{

        $selectStateNumber = $request->input('stateNumber');

        $result = car::with('client','person')->where('id','=', $selectStateNumber)->get();
        $clients = client::with('person')->find($result->map(fn($c)=>$c->client_id)->collect()->toArray());

        $cars = car::all();
        $malfunctions = malfunction::all();
        return view('clients.index',
            ['clients' => $clients, 'cars' => $cars, 'malfunctions' => $malfunctions, 'selectStateNumber' => $selectStateNumber, 'selectMalfunction' => 1]);
    }

    // Запрос 5
    //Фамилия, имя, отчество клиентов, сдавших в ремонт автомобили с указанным типом неисправности?
    public function selectClientByMalfunction(Request $request) : View{

        $selectMalfunction = $request->input('malfunction');

        $result = repair::with('client', 'person')->where('malfunction_id','=',$selectMalfunction)->get();
        $clients = client::with('person')->find($result->map(fn($c)=>$c->client_id)->collect()->toArray());

        $cars = car::all();
        $malfunctions = malfunction::all();
        return view('clients.index',
            ['clients' => $clients, 'cars' => $cars, 'malfunctions' => $malfunctions, 'selectStateNumber' => 1, 'selectMalfunction' => $selectMalfunction]);
    }


}
