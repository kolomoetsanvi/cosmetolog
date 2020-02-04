
@if($personnel)
    <div id="content-page" class="content group">
        <div class="container">

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

            <div class="hentry group">
                <h2>Работа с персоналом</h2>
                <div class="short-table white">
                    <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                        <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Фамилия Имя Отчество</th>
                            <th>Фото</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($personnel as $person)
                            <tr>
                                <td class="align-left">{{$person->id}}</td>
                                <td class="align-left "> <a href="{{route('admin.personnel.edit', ['id'=>$person->id])}}">{{$person->surname}} &nbsp {{$person->name}} &nbsp {{$person->patronymic}} </a></td>
                                <td class="align-left">
                                    <img style="max-height: 120px; max-width: 80px" src={{ asset("storage/assets/img/personnel/".$person->id."/personnel.jpg") }}  />
                                </td>
                                <td style="min-width: 100px">
                                    <form method="post" class="form-horizontal" action="{{route('admin.personnel.delete', ['id'=>$person->id])}}" >
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

                {{$personnel->links('layouts.paginate')}}
                <a href="{{route('admin.personnel.create')}}" class="btn btn-success btn-lg " role="button" aria-disabled="true">Добавить работника</a>
            </div>
        </div>
    </div>
@endif
