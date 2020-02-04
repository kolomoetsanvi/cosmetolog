<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Gate;

class PromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //    При отправке данных формы валидирует введенные данные и устанавливает правила для полей ввода
//    Используется в методах контроллеров вместо Request
//    В методе authorize() проверяем есть ли у пользователя права на осуществления данного действия
//    см. модель User метод canDo()
//
//    В методе rules() указываем правила валидации дл яполей ввод
//
//    В методе messages() указываем сообщения для правил валидации
//    Сообщения выводятся из сессии свойство: error

    public function authorize()
    {
        return Auth::user()->canDo('ADD_COSMETOLOGIES');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'new_cost' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению',
            'after' => 'Поле :attribute должнобыть датой после :date.',
            'before' => 'Поле :attribute должнобыть датой до :date.',
            'date' => 'Поле :attribute должно быть датой.',
            'numeric' => 'Поле :attribute должно быть числом.',

        ];
    }//function messages()
}
