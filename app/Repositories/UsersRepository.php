<?php

namespace App\Repositories;
use App\Http\Requests\UserRequest;
use App\User;
use Gate;

class UsersRepository extends Repository{

    public function __construct(User $user )
    {
        $this->model = $user;
    }//__construct(User $user )



    public function addUser(UserRequest $request)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('editUser', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();

            $user = User::create([
               'name' => $data['name'],
               'login' => $data['login'],
               'email' => $data['email'],
               'password' => bcrypt($data['password'])
            ]);

            if($user){
                $user->roles()->attach($data['selectRoles']);
            }

            return ['status' => 'Пользователь добавлен'];

   }//   addUser(UserRequest $request)



    public function updateUser(UserRequest $request, $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('editUser', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();


        $user = User::find($id);
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
       }


        $user->update(
            [
                'name' => $data['name'],
                'login' => $data['login'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

        if(!$user){return back()->with(['error' => 'ошибка редактирования']);}
        $user->roles()->sync([$data['selectRoles']]);


        return ['status' => 'Данные пользователя обновлены'];

    }//   addUser(UserRequest $request)


    public function deleteUser( $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if (Gate::denies('editUser', $this->model)) {
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $user = User::find($id);

        $user->roles()->detach();
        $user->delete();
        if(!$user){return back()->with(['error' => 'ошибка удаления']);}

        return ['status' => 'Пользователь удален'];

    }//deleteUser( $id)
}

