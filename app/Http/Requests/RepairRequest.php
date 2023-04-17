<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RepairRequest extends FormRequest{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $today = date("Y-m-d");

        return [

            'date_of_detection'=>"bail|required|date|before_or_equal:$today",
            'date_of_correction'=>"bail|required|date|after_or_equal:date_of_detection",

            'malfunction'=>'bail|required|numeric|min:1',
            'spare_part'=>'bail|required|numeric|min:1',
            'worker'=>'bail|required|numeric|min:1',
            'client'=>'bail|required|numeric|min:1',
            'car'=>'bail|required|numeric|min:1',
        ];
    }

    // вывод сообщений
    public function messages()
    {
        return [
            'date_of_detection.required' => 'Поле Дата сдачи авто должно быть заполнено',
            'date_of_correction.required' => 'Поле Дата возвращения авто должно быть заполнено',
            'malfunction.required' => 'Поле Неисправность должно быть заполнено',
            'spare_part.required' => 'Поле Деталь для ремонта должно быть заполнено',
            'worker.required' => 'Поле Id рабочего должно быть заполнено',
            'client.required' => 'Поле Id клиента должно быть заполнено',
            'car.required' => 'Поле Id авто должно быть заполнено',

            'date_of_detection.before_or_equal' => 'Поле Дата сдачи авто НЕ должно быть больше текущей даты',
            'date_of_correction.after_or_equal' => 'Поле Дата возвращения авто НЕ должно быть больше даты сдачи авто в ремонт',

            'malfunction.numeric' => 'Поле Неисправность должно содержать число (id)',
            'spare_part.numeric' => 'Поле Деталь для ремонта должно содержать число (id)',
            'worker.numeric' => 'Поле Id рабочего должно содержать число (id)',
            'client.numeric' => 'Поле Id клиента должно содержать число (id)',
            'car.numeric' => 'Поле Id авто должно содержать число (id)',

            'malfunction.min' => 'Значение в поле Неисправность должно быть не менее 1',
            'spare_part.min' => 'Значение в поле Деталь для ремонта должно быть не менее 1',
            'worker.min' => 'Значение в поле Id рабочего должно быть не менее 1',
            'client.min' => 'Значение в поле Id клиента должно быть не менее 1',
            'car.min' => 'Значение в поле Id авто должно быть не менее 1',

        ];
    }
}


