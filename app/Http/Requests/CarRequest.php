<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $curYear = date("Y");;
        return [
            'year_of_release' => "bail|required|numeric|min:1990|max:$curYear",
            'state_number'=>'bail|required|string|alpha_num|min:8|max:9',

            'brand'=>'bail|required|string|min:2|max:150',
            'color'=>'bail|required|string|min:2|max:150',
            'owner'=>'bail|required|numeric|min:1',
        ];
    }

    // вывод сообщений
    public function messages()
    {
        $curYear = date("Y");;
        return [
            'year_of_release.required' => 'Поле Год выпуска должно быть заполнено',
            'state_number.required' => 'Поле Гос номер должно быть заполнено',
            'brand.required' => 'Поле Модель авто должно быть заполнено',
            'color.required' => 'Поле Цвет авто должно быть заполнено',
            'owner.required' => 'Поле Владелец авто должно быть заполнено',

            'year_of_release.numeric' => 'Поле Год выпуска должно содержать число',
            'owner.numeric' => 'Поле Владелец авто должно содержать число (id)',

            'state_number.alpha_num' => 'Поле Гос номер должно содержать только буквы и цифры',

            'brand.min' => 'Поле Модель авто должно содержать хотя бы 2 символа',
            'color.min' => 'Поле Цвет авто должно содержать хотя бы 2 символа',
            'state_number.min' => 'Поле Гос номер должно содержать хотя бы 8 символов',
            'year_of_release.min' => 'Значение в поле Год выпуска должно быть не менее 1990',
            'owner.min' => 'Значение в поле Владелец авто должно быть не менее 1',


            'color.max' => 'Поле Цвет авто должно содержать не больше 150 символов',
            'brand.max' => 'Поле Модель авто должно содержать не больше 150 символов',
            'state_number.max' => 'Поле Гос номер должно содержать не больше 9 символов',

            'year_of_release.max' => "Значение в поле Год выпуска должно быть не более $curYear"
        ];
    }
}

