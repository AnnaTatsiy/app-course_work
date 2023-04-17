<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepairRequest;
use App\Models\car;
use App\Models\client;
use App\Models\malfunction;
use App\Models\repair;
use App\Models\spare_part;
use App\Models\worker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RepairsController extends Controller
{
    // получить все записи
    public function repairs(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $cars = car::with('brand','color')->get();

        $repairs = DB::select("SELECT * FROM db_course_work02_tatsiy.view_repairs;");
        return view('repairs.index', ['repairs' => $repairs, 'title' => "Ремонты на выполнении:", 'pageActive' => "repairsActive", 'cars' => $cars  ,'is_repairs' => true]);
    }

    //получить данные из архива
    public function archive(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $repairs = DB::select("SELECT * FROM db_course_work02_tatsiy.view_archive;");
        return view('repairs.index', ['repairs' => $repairs, 'title' => "Архив станции:", 'pageActive' => "archiveActive", 'is_repairs' => false]);
    }

    //форма с валидацией для добавления ремонта
    public function createForm(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $malfunctions = malfunction::all();
        $spare_parts = spare_part::all();
        $workers = worker::with('person')->get();
        $clients = client::with('person')->get();
        $cars = car::with('brand', 'color')->get();

        return view('repairs.create-form',
            [
                'isAdd' => true,
                'malfunctions' => $malfunctions,
                'spare_parts' => $spare_parts,
                'workers' => $workers,
                'clients' => $clients,
                'cars' => $cars
            ]);
    }

    // обработчик формы добавления ремонта (с валидацией)
    public function add(RepairRequest $request): View
    {
        return $this->saveInDB(new repair(), $request, 'Добавление записи');
    }

    //сохранение записи в бд
    private function saveInDB(repair $repair, RepairRequest $request, string $operation): View
    {

        //ищем неисправность по id
        $id_malfunction = malfunction::all()->where('id', $request->input('malfunction'))->first();

        //ищем Деталь для ремонта по id
        $id_spare_part = spare_part::all()->where('id', $request->input('spare_part'))->first();

        //ищем рабочего по id
        $id_worker = worker::all()->where('id', $request->input('worker'))->first();

        //ищем владельца по Id
        $id_client = client::all()->where('id', $request->input('client'))->first();

        //авто по Id
        $id_car = car::all()->where('id', $request->input('car'))->first();

        //если не нашли неисправность, то выдаем страницу с ошибкой
        if ($id_malfunction == null) {

            $id = $request->input('malfunction');

            return view('repairs.error', [
                'description' => "Неисправность c id = $id не найдена",
                'operation' => $operation
            ]);
        }

        //если не нашли Деталь для ремонта, то выдаем страницу с ошибкой
        if ($id_spare_part == null) {

            $id = $request->input('spare_part');

            return view('repairs.error', [
                'description' => "Деталь для ремонта c id = $id не найдена",
                'operation' => $operation
            ]);
        }

        //если не нашли рабочего, то выдаем страницу с ошибкой
        if ($id_worker == null) {

            $id = $request->input('worker');

            return view('repairs.error', [
                'description' => "Рабочий c id = $id не найден",
                'operation' => $operation
            ]);
        }

        //если не нашли клиента, то выдаем страницу с ошибкой
        if ($id_client == null) {

            $id = $request->input('client');

            return view('repairs.error', [
                'description' => "Клиент c id = $id не найден",
                'operation' => $operation
            ]);
        }

        //если не нашли авто, то выдаем страницу с ошибкой
        if ($id_car == null) {

            $id = $request->input('car');

            return view('repairs.error', [
                'description' => "Авто c id = $id не найден",
                'operation' => $operation
            ]);
        }

        $repair->date_of_detection = $request->input('date_of_detection');
        $repair->date_of_correction = $request->input('date_of_correction');

        $repair->is_fixed = ($request->input('is_fixed') == 'done') ? 1 : 0;

        $repair->malfunction_id = $request->input('malfunction');
        $repair->worker_id = $request->input('worker');
        $repair->car_id = $request->input('car');
        $repair->client_id = $request->input('client');
        $repair->spare_part_id = $request->input('spare_part');

        $repair->save();
        return $this->repairs();
    }

    //форма для редактирования ремонта
    public function editForm($id): View
    {

        $repair = repair::all()
            ->where('id', $id)
            ->first();

        $malfunctions = malfunction::all();
        $spare_parts = spare_part::all();
        $workers = worker::with('person')->get();
        $clients = client::with('person')->get();
        $cars = car::with('brand', 'color')->get();

        return view('repairs.create-form', [
            'isAdd' => false,
            'id' => $id,

            'date_of_detection' => $repair->date_of_detection,
            'date_of_correction' => $repair->date_of_correction,
            'is_fixed' => 0,
            'malfunction' => $repair->malfunction_id,
            'worker' => $repair->worker_id,
            'car' => $repair->car_id,
            'client' => $repair->client_id,
            'spare_part' => $repair->spare_part_id,

            'malfunctions' => $malfunctions,
            'spare_parts' => $spare_parts,
            'workers' => $workers,
            'clients' => $clients,
            'cars' => $cars
        ]);
    }

    // обработчик формы для редактирования ремонта
    public function edit(RepairRequest $request): View
    {
        //ищем ремонт по id
        $repair = repair::all()
            ->where('id', $request->input('id'))
            ->first();

        if ($repair != null) return $this->saveInDB($repair, $request, 'Редактирование записи');

        return $this->repairs();
    }

    //"мягкое" удаление ремонта по id
    public function delete($id): View{

        $repair = repair::all()
            ->where('id', $id)
            ->first();

        $repair->delete();
        return $this->repairs();
    }

    //генерация расписки
    public function generateReceipt($id): \Illuminate\Http\Response{
        return $this->generate($id,'pdf.export-receipt', "расписка_авто_c_id=$id.pdf",false);
    }

    public function generate($id, string $page, string $fileName, bool $isAccount) : \Illuminate\Http\Response{

        $date_of_detection = DB::select("call find_min_date_in_repairs_by_id_car($id);");
        $date_of_correction = DB::select("call find_max_date_in_repairs_by_id_car($id);");
        $malfunctions = DB::select("call find_malfunctions_in_repairs_by_id_car($id);");

        $total = array_reduce($malfunctions,fn($sum,$item)=>$sum + $item->malfunctions_price + $item->spare_part_price,0);

        $pdf = Pdf::loadView($page, [
            'date_of_detection' => $date_of_detection[0]->min_date,
            'date_of_correction' => $date_of_correction[0]->max_date,
            'date' => date("d.m.Y"),
            'total' => $total,
            'malfunctions' => $malfunctions
        ]);

        //отмечаем ремонт как завершенный
        if($isAccount){

            //ищем ремонты по id авто
            $repairs = repair::all()
                ->where('car_id', $id);

            //завершаем
            foreach ($repairs as $repair){
                $repair->is_fixed = 1;
                $repair->save();
            }
        }

        return $pdf->download($fileName);
    }

    //генерация счета
    public function generateAccount($id): \Illuminate\Http\Response{
        return $this->generate($id,'pdf.export-account', "счет_авто_c_id=$id.pdf",true);
    }
}
