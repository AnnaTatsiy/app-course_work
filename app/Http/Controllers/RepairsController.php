<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\repair;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairsController extends Controller
{
    // получить все записи
    public function repairs(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $repairs = DB::select("SELECT * FROM db_course_work02_tatsiy.view_repairs;");
        return view('repairs.index', ['repairs' => $repairs, 'title' => "Ремонты на выполнении:", 'pageActive' => "repairsActive"]);
    }

    //получить данные из архива
    public function archive() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View{

        $repairs = DB::select("SELECT * FROM db_course_work02_tatsiy.view_archive;");
        return view('repairs.index', ['repairs' => $repairs, 'title' => "Архив станции:", 'pageActive' => "archiveActive"]);
    }
}
