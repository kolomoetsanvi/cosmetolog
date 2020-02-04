    <div class="container">
        </br>
        <div class="row bg-info text-white">
            <div class="col-md-4 ">
                <h3> Количество посетителей: {{$viewsCount}}</h3>
            </div >
        </div >
        <div class="row bg-info text-white">
            <div class="col-md-3">
                <p> Количество косметологов: </p>
            </div >
            <div class="col-md-1">
                <p> {{$cCount}}</p>
            </div >
            <div class="col-md-3 offset-2">
                <p> Просмотров косметологов: </p>
            </div >
            <div class="col-md-1">
                <p> {{$сViewsCount}}</p>
            </div >
        </div >
        <div class="row bg-info text-white">
            <div class="col-md-3">
                <p> Количество статей:</p>
            </div >
            <div class="col-md-1">
                <p> {{$aCount}}</p>
            </div >
            <div class="col-md-3 offset-2">
                <p> Просмотров статей: </p>
            </div >
            <div class="col-md-1">
                <p> {{$aViewsCount}}</p>
            </div >
        </div >
        </br>
    </div >



            <div class="short-table white">
                <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Отчеты</th>
                            <th>Содержание</th>
                        </tr>
                     </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                               <td class="align-left">
                                   Отчет &nbsp {{$report['id']}}
{{--                               <a href="#tab{{$report['id']}}" role="tab" data-toggle="tab">Отчет &nbsp {{$report['id']}}</a>--}}
                               </td>
                               <td class="align-left">{{$report['title']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

