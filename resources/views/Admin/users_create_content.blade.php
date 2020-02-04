{{--используется для создания и редактирования пользователей--}}
{{--если есть в запросе id - редактирование, нет - создание--}}
<div id="content-page" class="content group">
    <div class="container">
        <div class="hentry group">
            <h2>{{$strTitle}}</h2>


            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif



            <form method="post" class="form" enctype="multipart/form-data" action="{{ (isset($user->id)) ?  route('admin.users.update', ['id'=>$user->id]) :  route('admin.users.store') }}" >
                {{ csrf_field() }}


                <ul style=" list-style-type: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Имя пользователя:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="name" id="name" value="{{(isset($user->name)) ? $user->name : old('name')}}" placeholder="Введите имя" >
                                    </br></br>
                                </div>
                            </li>
                        </div>
                        <div class="col-md-6">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Логин:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="login" id="login" value="{{(isset($user->login)) ? $user->login : old('login')}}" placeholder="Введите логин" >
                                    </br></br>
                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Email:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="email" id="email" value="{{(isset($user->email)) ? $user->email : old('email')}}" placeholder="Введите email" >
                                    </br></br>
                                </div>
                            </li>
                        </div>
                        <div class="col-md-6">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Пароль:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="password" name="password" id="password" value="{{(isset($user->password)) ? $user->password : old('name')}}" placeholder="Введите пароль" >
                                    </br></br>
                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Повтор пароля:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="Подтверждение пароля" >
                                    </br></br>
                                </div>
                            </li>
                        </div>
                        <div class="col-md-6">

                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Роли:</span>
                                </label>
                                <div class="input-prepend"></span>
                                    <select class="form-control" id="selectRoles" name="selectRoles" size="1" >
                                         @foreach($roles as $role)
                                            @if(isset($user->id) && $role->id == $user->roles()->first()->id )
                                                 <option selected="selected" value="{{$role->id}}">{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </br>
                                </div>
                            </li>
                        </div>
                    </div>

                    <li class="submit-button">
                        </br></br>
                        <input class="btn btn-success" type="submit" value="Сохранить" />
                    </li>
                </ul>
            </form>


        </div>
    </div>
</div>



