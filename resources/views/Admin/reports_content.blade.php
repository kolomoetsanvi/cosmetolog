<div id="content-page" class="content group">
    <div class="container">
            <h3 class="title_page">Отчеты</h3>

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


                <section>
                    <div class="panel panel-primary" id="reportPanel">
                       <div class="panel-body">
                            <ul class="nav nav-tabs nav-justified" role="tablist" id="tabReport" name="tabReport">
                                <li class="active border-left border-top border-right" style="padding: 10px">
                                    <a href="#mainTab" role="tab" data-toggle="tab">Главная</a>
                                </li>
                                @foreach ($reports as $report)
                                     <li  class="border-top border-right" style="padding: 10px">
                                         <a href="#tab{{$report['id']}}" role="tab" data-toggle="tab">Отчет &nbsp {{$report['id']}}</a>
                                     </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade in active" id="mainTab">
                                    @section('mainTab')
                                        @include('admin.reports_content_mainTab')
                                    @show
                                </div><!--class="tab-pane fade in active" id="mainTab">-->


                                @foreach ($reports as $report)
                                    <div class="tab-pane fade" id="tab{{$report['id']}}">

                                        </br>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <h5 class=""  style="padding: 3px" >{{$report['title']}}</h5>
                                            </div >
                                        </div >
                                        </br>

                                        <div class="short-table white">
                                            <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                                                <thead>
                                                <tr>
                                                    @foreach ($report['cellsTitle'] as $cell)
                                                         <th>{{$cell}}</th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($report['data'] as $item)
                                                        <tr>
                                                             @foreach ($report['cells'] as $cell)
                                                                  <td class="align-left">{{$item[$cell]}}</td>
                                                             @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                @endforeach
                             </div> <!-- <div class="tab-content"> -->

                        </div> <!--<div class="panel-body">-->
                    </div>  <!--<div class="panel panel-primary" id="panelStr3">-->
                </section>


{{--                активируем первую страницу--}}
               <script>
                   $(function(){
                         $('#tabReport a:first').tab('show');
                   });//$(function()
               </script>

    </div>
</div>

