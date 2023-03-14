<?php

namespace App\Http\Controllers;

use App\Models\malfunction;
use Illuminate\Http\Request;

use App\Models\car;
use App\Models\_brand;
use App\Models\Client;
use App\Models\repair;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MalfunctionsController extends Controller
{
    //вывод всех неисправностей
    public function malfunctions(): View {

        $malfunctions = malfunction::all();
        $owners = Client::with('person')->get();

        return view('malfunctions.index',
            ['malfunctions' => $malfunctions, 'owners' => $owners, 'selectOwner' => 1]);
    }

    //Запрос 3
    //Перечень устраненных неисправностей в автомобиле данного владельца
    public function malfunctionsSelectByOwner(Request $request) : View{

        $selectOwner = $request->input('owner');

        $result = repair::with('malfunction')
            ->where('client_id', '=',$selectOwner)
            ->where('is_fixed','=',1)
            ->get();
        $malfunctions = malfunction::all()->find($result->map(fn($c)=>$c->malfunction_id)->collect()->toArray());

        $owners = Client::with('person')->get();
        return view('malfunctions.index',
            ['malfunctions' => $malfunctions, 'owners' => $owners, 'selectOwner' => $selectOwner]);
    }
}
