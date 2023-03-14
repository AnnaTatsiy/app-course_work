<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utils;
use App\Models\repair;
use App\Models\worker;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{

    //отобразить главную страницу
    public function index() : View{

        //количестве незанятых рабочих на текущий момент.
        $free_workers = Worker::all()->count() - count(DB::select('call free_workers();'));

        //Запрос 8
        //Необходимо предусмотреть возможность выдачи справки о количестве автомобилей в ремонте на текущий момент
        $count_cars = repair::with('car')
                ->where('is_fixed','=',false)
                ->where('date_of_correction','>', new DateTime())
                ->distinct()
                ->count();

        $selectMonth = date('m');
        $report = DB::select("call month_report_about_profit($selectMonth);");

        return view('home.index',
            ['free_workers' => $free_workers, 'count_cars' => $count_cars, 'months' => Utils::$months, 'report' => $report]);
    }

    public function about() : View{
        return view('home.about');
    }

    // Запрос 10
    // Требуется также выдача месячного отчета о работе станции
    // техобслуживания. В отчет должны войти данные о количестве
    // устраненных неисправностей каждого вида и о доходе, полученном станцией,
    public function showReport(Request $request){

        $selectMonth = $request->input('month');

        $report = DB::select("call month_report_about_profit($selectMonth);");

        return view('home.report',
            ['selectMonth' => $selectMonth,  'months' => Utils::$months ,'report' => $report]);
    }

}
