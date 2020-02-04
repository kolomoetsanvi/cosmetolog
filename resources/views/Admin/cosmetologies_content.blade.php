
@if($cosmetologies)
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
                <h2>Работа с косметологиями</h2>
                <div class="short-table white">
                    <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                        <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Название</th>
                            <th>Адрес</th>
                            <th>Изображение</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cosmetologies as $cosmetolog)
                            <tr>
                                <td class="align-left">{{$cosmetolog->id}}</td>
                                <td class="align-left "> <a href="{{route('admin.cosmetologies.edit', ['id'=>$cosmetolog->id])}}">{{$cosmetolog->title}} </a></td>
                                <td class="align-left">{{$cosmetolog->address}}</td>
                                <td class="align-left">
                                    <img style="max-height: 80px; max-width: 120px" src={{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/main/main.jpg") }}  />
                                </td>
                                <td style="min-width: 100px">
                                    <form method="post" class="form-horizontal" action="{{route('admin.cosmetologies.delete', ['id'=>$cosmetolog->id])}}" >
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

                {{$cosmetologies->links('layouts.paginate')}}
                <a href="{{route('admin.cosmetologies.create')}}" class="btn btn-success btn-lg " role="button" aria-disabled="true">Добавить косметолога</a>
            </div>
        </div>
    </div>
@endif
