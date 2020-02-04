<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Gate;

class CosmetologRequest extends FormRequest
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


    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('e_mail', 'required|email|max:255', function($input)
        {
            if(!empty($input->e_mail))
            {return TRUE;}

            return FALSE;
        });

        return $validator;
    }//function getValidatorInstance()



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'max:255',
            'work_schedule' => 'max:255',
            'site' => 'max:255',
            'brief' => 'required',
            'vk' => 'max:255',
            'ok' => 'max:255',
            'fb' => 'max:255',
            'inst' => 'max:255',
        ];
    }//function rules()


    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению',
            'max' => 'Максимальное допустимое количество символов - :max',
            'email' => 'Поле :attribute должно быть электронным адресом.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
        ];
    }//function messages()
}
