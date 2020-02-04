
@if($services)
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
                <h2>Работа с услугами</h2>
                <div class="short-table white">
                    <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                        <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Название</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td class="align-left"><a href="{{route('admin.services.edit', ['id'=>$service->id])}}">{{$service->id}}</a></td>
                                <td class="align-left " name="title"> {{$service->title}}</td>
                                <td style="min-width: 100px">
                                    <form method="post" class="form-horizontal" action="{{route('admin.services.delete', ['id'=>$service->id])}}" >
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

                {{$services->links('layouts.paginate')}}
                <a href="{{route('admin.services.create')}}" class="btn btn-success btn-lg " role="button" aria-disabled="true">Добавить услугу</a>
            </div>
        </div>
    </div>
@endif
