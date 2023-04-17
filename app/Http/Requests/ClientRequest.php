<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest{

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
        return [
            'name'=>'bail|required|string|alpha|min:2|max:100',
            'surname'=>'bail|required|string|alpha|min:2|max:100',
            'patronymic'=>'bail|required|string|alpha|min:2|max:100',
            'passport'=>'bail|required|string|alpha_num|min:8|max:10',
            'registration'=>'bail|required|string|min:10|max:1000',
            'date_of_birth'=>'bail|required|date|after:1923-01-01|before:2005-01-01',
        ];
    }

    // вывод сообщений
    public function messages()
    {
        return [
            'name.required' => 'Поле Имя должно быть заполнено',
            'surname.required' => 'Поле Фамилия должно быть заполнено',
            'patronymic.required' => 'Поле Отчество должно быть заполнено',
            'passport.required' => 'Поле Паспорт должно быть заполнено',
            'registration.required' => 'Поле Адрес проживания должно быть заполнено',
            'date_of_birth.required' => 'Поле Дата рождения должно быть заполнено',

            'name.alpha' => 'Поле Имя не должно содержать цифр',
            'surname.alpha' => 'Поле Фамилия не должно содержать цифр',
            'patronymic.alpha' => 'Поле Отчество не должно содержать цифр',

            'passport.alpha_num' => 'Поле Паспорт должно содержать только цифры',

            'name.min' => 'Поле Имя должно содержать хотя бы 2 символа',
            'surname.min' => 'Поле Фамилия должно содержать хотя бы 2 символа',
            'patronymic.min' => 'Поле Отчество должно содержать хотя бы 2 символа',
            'passport.min' => 'Поле Паспорт должно содержать хотя бы 8 символов',
            'registration.min' => 'Поле Адрес проживания должно содержать хотя бы 10 символов',

            'name.max' => 'Поле Имя должно содержать не больше 100 символов',
            'surname.max' => 'Поле Фамилия должно содержать не больше 100 символов',
            'patronymic.max' => 'Поле Отчество должно содержать не больше 100 символов',
            'passport.max' => 'Поле Паспорт должно содержать не больше 10 символов',
            'registration.max' => 'Поле Адрес проживания должно содержать не больше 1000 символов',

            'date_of_birth.after' => 'Клиенту дольжно быть меньше 100 лет',
            'date_of_birth.before' => 'Клиенту дольжно исполнится 18 лет'
        ];
    }

}
