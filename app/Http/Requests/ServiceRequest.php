<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Gate;


//    При отправке данных формы валидирует введенные данные и устанавливает правила для полей ввода
//    Используется в методах контроллеров вместо Request
//    В методе authorize() проверяем есть ли у пользователя права на осуществления данного действия
//    см. модель User метод canDo()
//
//    В методе rules() указываем правила валидации дл яполей ввод
//
//    В методе messages() указываем сообщения для правил валидации
//    Сообщения выводятся из сессии свойство: error
class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
           'title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению',
        ];
    }//function messages()
}
