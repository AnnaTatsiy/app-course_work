<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\client;
use App\Models\malfunction;
use App\Models\repair;
use App\Models\specialization;
use Illuminate\Http\JsonResponse;
use App\Models\worker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WorkersController extends Controller
{
    // получить все записи
    public function workers(): View
    {

        $workers = Worker::with('person', 'specialization')->get();

        $clients = Client::with('person')->get();
        $malfunctions = malfunction::all();

        return view('workers.index',
            ['workers' => $workers, 'clients' => $clients, 'malfunctions' => $malfunctions, 'selectClient' => 1, 'selectMalfunction' => 1]);
    }

    //Запрос 4
    //Фамилия, имя, отчество работника станции, устранявшего данную неисправность в автомобиле данного клиента, и время ее устранения
    public function workerSelectByMalfunctionsAndOwner(Request $request): View{

        $selectClient = $request->input('client');
        $selectMalfunction = $request->input('malfunction');

        $result = repair::with('worker')
            ->where('client_id', '=', $selectClient)
            ->where('malfunction_id', '=', $selectMalfunction)
            ->get();
        $workers = worker::with('person','specialization')->find($result->map(fn($c)=>$c->worker_id)->collect()->toArray());

        $clients = Client::with('person')->get();
        $malfunctions = malfunction::all();

        return view('workers.index',
            ['workers' => $workers, 'clients' => $clients, 'malfunctions' => $malfunctions, 'selectClient' => $selectClient, 'selectMalfunction' => $selectMalfunction]);
    }
}
