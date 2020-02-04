<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Gate;
use Illuminate\Http\Request;

//    При отправке данных формы валидирует введенные данные и устанавливает правила для полей ввода
//    Используется в методах контроллеров вместо Request
//    В методе authorize() проверяем есть ли у пользователя права на осуществления данного действия
//    см. модель User метод canDo()
//
//    В методе rules() указываем правила валидации дл яполей ввод
//
//    В методе messages() указываем сообщения для правил валидации
//    Сообщения выводятся из сессии свойство: error
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo('EDIT_USERS');
    }


    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', 'required|min:6|confirmed', function($input)
        {
            if(!empty($input->password) || (empty($input->password) && $this->route()->getName() !== 'admin.users.update'))
            {return TRUE;}

            return FALSE;
        });

        return $validator;
    }//function getValidatorInstance()



    public function rules(Request $request)
    {
//        $id = (isset($this->route()->parameter('user')->id)) ? $this->route()->parameter('user')->id: '';
        $id = ($request->route('id')) ? $request->route('id') : '';
        return [
            'name' => 'required|max:255',
            'login' => 'required|max:255|unique:users,login,'.$id,
            'selectRoles' => 'required|integer',
            'email' => 'required|email|max:255|unique:users,email,'.$id

        ];
    }//public function rules()


    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению',
            'max' => 'Максимальное допустимое количество символов - :max',
            'min' => 'Минимальное допустимое количество символов - :min',
            'email' => 'Поле :attribute должно быть электронным адресом.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'unique' => 'Поле :attribute уже используется.',
            'confirmed' => 'Значения поля Пароль и Повтор пароля не сопадвют.',
        ];
    }//function messages()



}
