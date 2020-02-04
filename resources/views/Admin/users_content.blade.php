
@if($users)
    <div id="content-page" class="content group">
        <div class="container">
            <br class="hentry group">

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

                <h2>Работа c пользователями</h2>
                <div class="short-table white">
                    <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                        <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Имя</th>
                            <th>Эл. почта</th>
                            <th>Логин</th>
                            <th>Роль</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="align-left">{{$user->id}}</td>
                                <td class="align-left "> <a href="{{route('admin.users.edit', ['id'=>$user->id])}}">{{$user->name}} </a></td>
                                <td class="align-left">{{$user->email}}</td>
                                <td class="align-left">{{$user->login}}</td>
                                <td class="align-left">{{$user->roles->implode('name', ', ')}}</td>
                                <td style="min-width: 100px">
                                    <form method="post" class="form-horizontal" action="{{route('admin.users.delete', ['id'=>$user->id])}}" >
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input class="btn btn-danger " type="submit" value="Удалить" style="margin-left: 10px"/>
                                        </div>
                                    </form>

                                 </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{$users ->links('layouts.paginate')}}
                </br>
                <a href="{{route('admin.users.create')}}" class="btn btn-success btn-lg " role="button" aria-disabled="true">Добавить пользователя</a>
            </div>
        </div>
    </div>
@endif
