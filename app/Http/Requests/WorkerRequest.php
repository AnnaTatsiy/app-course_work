<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest{

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

            'workers_category' => 'bail|required|numeric|min:1|max:8',
            'experience' => 'bail|required|numeric|min:1|max:20',
            'specialization'=>'bail|required|string|alpha|min:2|max:100'
        ];
    }

    // вывод сообщений
    public function messages()
    {
        return [
            'name.required' => 'Поле Имя должно быть заполнено',
            'surname.required' => 'Поле Фамилия должно быть заполнено',
            'patronymic.required' => 'Поле Отчество должно быть заполнено',
            'workers_category.required' => 'Поле Разряд должно быть заполнено',
            'experience.required' => 'Поле Стаж работы должно быть заполнено',
            'specialization.required' => 'Поле Специальность должно быть заполнено',

            'name.alpha' => 'Поле Имя не должно содержать цифр',
            'surname.alpha' => 'Поле Фамилия не должно содержать цифр',
            'patronymic.alpha' => 'Поле Отчество не должно содержать цифр',
            'specialization.alpha' => 'Поле Специальность не должно содержать цифр',

            'workers_category.numeric' => 'Поле Разряд должно содержать число',
            'experience.numeric' => 'Поле Стаж работы должно содержать число',

            'name.min' => 'Поле Имя должно содержать хотя бы 2 символа',
            'surname.min' => 'Поле Фамилия должно содержать хотя бы 2 символа',
            'patronymic.min' => 'Поле Отчество должно содержать хотя бы 2 символа',
            'specialization.min' => 'Поле Специальность должно содержать хотя бы 2 символа',

            'workers_category.min' => 'Значение в поле Разряд должно быть не менее 1',
            'experience.min' => 'Значение в поле Стаж работы должно быть не менее 1',

            'name.max' => 'Поле Имя должно содержать не больше 100 символов',
            'surname.max' => 'Поле Фамилия должно содержать не больше 100 символов',
            'patronymic.max' => 'Поле Отчество должно содержать не больше 100 символов',
            'specialization.max' => 'Поле Специальность должно содержать не больше 100 символов',

            'workers_category.max' => 'Значение в поле Разряд должно быть не более 8',
            'experience.max' => 'Значение в поле Стаж работы должно быть не более 20'
        ];
    }
}
