<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utils;
use App\Http\Requests\CarRequest;
use App\Http\Requests\WorkerRequest;
use App\Models\brand;
use App\Models\car;
use App\Models\client;
use App\Models\color;
use App\Models\specialization;
use App\Models\worker;
use Illuminate\Foundation\Http\FormRequest;
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

    //форма с валидацией для добавления авто
    public function createForm() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View{

        $brands = brand::all();
        $colors = color::all();
        $owners = client::with('person')->get();;

        return view('cars.create-form',
            [
                'isAdd' => true,
                'brands' => $brands,
                'colors' => $colors,
                'owners' => $owners
            ]);
    }

    // обработчик формы добавления авто (с валидацией)
    public function add(CarRequest $request): View {
      return $this->saveInDB(new car(), $request,'Ошибка добавления авто','Добавление');
    }

    private function saveInDB(car $car, CarRequest $request, string $description, string $operation) : View {

        //ищем владельца по Id
        $id = client::all()->where('id',$request->input('owner'))->first();

        //если не нашли, то выдаем страницу с ошибкой
        if($id == null){
            return view('cars.error', [
                'description' => $description,
                'id' => $request->input('owner'),
                'operation' => $operation
            ]);
        }

        $car->year_of_release = $request->input('year_of_release');
        $car->state_number = $request->input('state_number');
        $car->brand_id = $this->findBrandIdByParam($request);
        $car->color_id = $this->findColorIdByParam($request);
        $car->client_id = $request->input('owner');

        $car->save();
        return $this->cars();
    }

    //форма для редактирования авто
    public function editForm($id): View {
        $car = car::with('brand','color')
            ->where('id',$id)
            ->first();

        $brands = brand::all();
        $colors = color::all();
        $owners = client::with('person')->get();

        return view('cars.create-form', [
            'isAdd' => false,
            'id'=>$id,
            'year_of_release'=>$car->year_of_release,
            'state_number' => $car->state_number,
            'brand' => $car->brand->name_brand,
            'color'=> $car->color->name_color,
            'owner' => $car->client_id,
            'brands' => $brands,
            'colors' => $colors,
            'owners' => $owners
        ]);
    }

    // обработчик формы для редактирования авто
    public function edit(CarRequest $request): View {

        //ищем авто по id
        $car = car::all()
            ->where('id',$request->input('id'))
            ->first();

        if($car != null) return $this->saveInDB($car, $request,'Ошибка редактирования авто','Редактирование');

        return $this->cars();
    }

    public static function findBrandIdByParam(FormRequest $request): int {

        //Ищем запись о таком модели
        $id = brand::all()
            ->where('name_brand',$request->input('brand'))->get('id');

        //Если не нашли то добавляем
        if(!($id > 0))
        {
            $brand= new brand();
            $brand ->name_brand = $request->input('brand');

            $brand->save();
            $id = $brand->id;
        }

        return $id;
    }

    public static function findColorIdByParam(FormRequest $request): int {

        //Ищем запись о таком цвете авто
        $id = color::all()
            ->where('name_color',$request->input('color'))->get('id');

        //Если не нашли то добавляем
        if(!($id > 0))
        {
            $color= new color();
            $color ->name_color = $request->input('color');

            $color->save();
            $id = $color->id;
        }

        return $id;
    }

}
