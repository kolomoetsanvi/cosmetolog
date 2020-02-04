<div id="content-page" class="content group">
    <div class="container">
        <h3 class="title_page">{{$strTitle}}</h3>

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
            <form method="post" class="form" enctype="multipart/form-data" action="{{ (isset($cosmetolog->id)) ?  route('admin.cosmetologies.update', ['id'=>$cosmetolog->id]) :  route('admin.cosmetologies.store') }}" >
                {{ csrf_field() }}
            <div class="panel panel-primary" id="reportPanel">
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified" role="tablist" id="tabReport" name="tabReport">
                        <li class="active border-left border-top border-right" style="padding: 10px">
                            <a href="#tabMain" role="tab" data-toggle="tab">Главная</a>
                        </li>
                        <li  class="border-top border-right" style="padding: 10px">
                            <a href="#tabInterior" role="tab" data-toggle="tab">Интерьер</a>
                        </li>
                        <li  class="border-top border-right" style="padding: 10px">
                            <a href="#tabPersonnel" role="tab" data-toggle="tab">Персонал</a>
                        </li>
                        <li  class="border-top border-right" style="padding: 10px">
                            <a href="#tabWorks" role="tab" data-toggle="tab">Работы</a>
                        </li>
                        <li  class="border-top border-right" style="padding: 10px">
                            <a href="#tabPrice" role="tab" data-toggle="tab">Прайс</a>
                        </li>
                        <li  style="padding: 10px; margin-left: 100px">
                            <input class="btn btn-success" type="submit" value="Сохранить" />
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="tabMain">
                            @section('tabMain')
                                @include('admin.cosmetologies_create_content_tabMain')
                            @show
                        </div>
                        <div class="tab-pane fade in active" id="tabInterior">
                            @section('tabInterior')
                                @include('admin.cosmetologies_create_content_tabInterior')
                            @show
                        </div>
                        <div class="tab-pane fade in active" id="tabPersonnel">
                            @section('tabPersonnel')
                                @include('admin.cosmetologies_create_content_tabPersonnel')
                            @show
                        </div>
                        <div class="tab-pane fade in active" id="tabWorks">
                            @section('tabWorks')
                                @include('admin.cosmetologies_create_content_tabWorks')
                            @show
                        </div>
                        <div class="tab-pane fade in active" id="tabPrice">
                            @section('tabPrice')
                                @include('admin.cosmetologies_create_content_tabPrice')
                            @show
                        </div>



                    </div> <!-- <div class="tab-content"> -->
                </div> <!--<div class="panel-body">-->
            </div>  <!--<div class="panel panel-primary" id="panelStr3">-->
            </form>
        </section>


        {{--                активируем первую страницу--}}
        <script>
            $(function(){
                $('#tabReport a:first').tab('show');
            });//$(function()
        </script>

    </div>
</div>

