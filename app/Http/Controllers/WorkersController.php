<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utils;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\WorkerRequest;
use App\Models\car;
use App\Models\client;
use App\Models\malfunction;
use App\Models\person;
use App\Models\repair;
use App\Models\specialization;
use Illuminate\Foundation\Http\FormRequest;
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

    //форма с валидацией для добавления рабочего
    public function createForm() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View{

        $specializations = specialization::all();

        return view('workers.create-form', ['isAdd' => true, 'specializations' => $specializations]);
    }


    // обработчик формы добавления рабочего (с валидацией)
    public function add(WorkerRequest $request): View
    {
        $this->saveInDB(new worker(), $request);
        return $this->workers();
    }

    private function saveInDB(worker $worker, WorkerRequest $request){
        $worker->workers_category = $request->input('workers_category');
        $worker->experience = $request->input('experience');
        $worker->specialization_id = $this->findSpecializationIdByParam($request);
        $worker->person_id = Utils::findPersonIdByParam($request);

        $worker->save();
    }

    public static function findSpecializationIdByParam(FormRequest $request): int {

        //Ищем запись о таком специальности
        $id = specialization::all()
            ->where('name_specialization',$request->input('specialization'))->get('id');

        //Если не нашли то добавляем
        if(!($id > 0))
        {
            $specialization = new specialization();
            $specialization ->name_specialization = $request->input('specialization');

            $specialization->save();
            $id = $specialization->id;
        }

        return $id;
    }

    //форма для редактирования клиента
    public function editForm($id): View {

        $worker = worker::with('person')
            ->where('id',$id)
            ->first();

        $specializations = specialization::all();

        return view('workers.create-form', [
            'isAdd' => false,
            'id'=>$id,
            'surname' => $worker->person->surname,
            'name' => $worker->person->name,
            'patronymic' => $worker->person->patronymic,
            'workers_category' => $worker->workers_category,
            'experience' => $worker->experience,
            'specialization' => $worker->specialization->name_specialization,
            'specializations' => $specializations
        ]);
    }

    // обработчик формы для редактирования клиента
    public function edit(WorkerRequest $request): View {

        //ищем клиента по id
        $worker = worker::with('person')
            ->where('id',$request->input('id'))
            ->first();

        if($worker != null) $this->saveInDB($worker, $request);

        return $this->workers();
    }

    //"мягкое" удаление рабочего по id
    public function delete($id): View {

        //не можем удалить рабочего который выполняет ремонт
        $worker_id = DB::select("select count(workers_id) as count from view_repairs where workers_id = $id;")[0];

        //если не нашли рабочего в таблице ремонты
        if ($worker_id->count == 0){

            $worker = worker::all()
                ->where('id',$id)
                ->first();

            $worker->delete();

            return $this->workers();
        }
        else return view('workers.error');
    }
}
