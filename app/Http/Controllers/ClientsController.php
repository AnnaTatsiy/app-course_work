<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utils;
use App\Http\Requests\ClientRequest;
use App\Models\car;
use App\Models\_brand;
use App\Models\Client;
use App\Models\malfunction;
use App\Models\person;
use App\Models\repair;
use Illuminate\Foundation\Http\FormRequest;
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

        $result = repair::with('client')->where('malfunction_id','=',$selectMalfunction)->get();
        $clients = client::with('person')->find($result->map(fn($c)=>$c->client_id)->collect()->toArray());

        $cars = car::all();
        $malfunctions = malfunction::all();
        return view('clients.index',
            ['clients' => $clients, 'cars' => $cars, 'malfunctions' => $malfunctions, 'selectStateNumber' => 1, 'selectMalfunction' => $selectMalfunction]);
    }

    //форма с валидацией для добавления клиента
    public function createForm() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View{
        return view('clients.create-form', ['isAdd' => true]);
    }

    // обработчик формы добавления клиента (с валидацией)
    public function add(ClientRequest $request): View
    {
        $this->saveInDB(new Client(), $request);
        return $this->clients();
    }

    private function saveInDB(client $client, ClientRequest $request){
        $client->passport = $request->input('passport');
        $client->registration = $request->input('registration');
        $client->date_of_birth = $request->input('date_of_birth');
        $client->person_id = Utils::findPersonIdByParam($request);

        $client->save();
    }

    //форма для редактирования клиента
    public function editForm($id): View {

        $client = Client::with('person')
            ->where('id',$id)
            ->first();

        return view('clients.create-form', [
            'isAdd' => false,
            'id'=>$id,
            'surname' => $client->person->surname,
            'name' => $client->person->name,
            'patronymic' => $client->person->patronymic,
            'passport' => $client->passport,
            'registration' => $client->registration,
            'date_of_birth' => $client->date_of_birth
        ]);
    }

    // обработчик формы для редактирования клиента
    public function edit(ClientRequest $request): View {

        //ищем клиента по id
        $client = Client::with('person')
            ->where('id',$request->input('id'))
            ->first();

        if($client != null) $this->saveInDB($client, $request);

        return $this->clients();
    }
}
