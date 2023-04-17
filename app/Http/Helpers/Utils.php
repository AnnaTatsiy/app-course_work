<?php

namespace App\Http\Helpers;
use App\Models\person;
use Illuminate\Foundation\Http\FormRequest;

class Utils
{

    public static function findPersonIdByParam(FormRequest $request): int {

        //Ищем запись о таком ФИО
        $id = person::all()
            ->where('name',$request->input('name'))
            ->where('surname',$request->input('surname'))
            ->where('patronymic', $request->input('patronymic'))->get('id');

        //Если не нашли то добавляем
        if(!($id  > 0))
        {
            $person = new person();
            $person->name = $request->input('name');
            $person->surname = $request->input('surname');
            $person->patronymic = $request->input('patronymic');

            $person->save();
            $id = $person->id;
        }

        return $id;
    }

    public static array $months = array(1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
}
