
@if($promotions)
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
                <h2>Работа с акциями</h2>
                <div class="short-table white">
                    <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                        <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Косметолог</th>
                            <th>Услуга</th>
                            <th>Начало </th>
                            <th>Окончание</th>
                            <th>Новая стоимость</th>
                            <th>Картинка</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($promotions as $promotion)
                            <tr>
                                <td class="align-left"><a href="{{route('admin.promotions.edit', ['id'=>$promotion->id])}}">{{$promotion->id}}</a></td>
                                <td class="align-left "> {{$promotion->cosmetologie->title}} </td>
                                <td class="align-left "> {{$promotion->service->title}} </td>
                                <td class="align-left "> {{$promotion->start}} </td>
                                <td class="align-left "> {{$promotion->end}} </td>
                                <td class="align-left "> {{$promotion->new_cost}} </td>


                                <td class="align-left">
                                    <img style="max-height: 120px; max-width: 80px" src={{ asset("storage/assets/img/promotion/".$promotion->id.".jpg") }}  />
                                </td>
                                <td style="min-width: 100px">
                                    <form method="post" class="form-horizontal" action="{{route('admin.promotions.delete', ['id'=>$promotion->id])}}" >
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
                </br>
                {{$promotions->links('layouts.paginate')}}
                </br>
                <a href="{{route('admin.promotions.create')}}" class="btn btn-success btn-lg " role="button" aria-disabled="true">Добавить акцию</a>
            </div>
        </div>
    </div>
@endif

