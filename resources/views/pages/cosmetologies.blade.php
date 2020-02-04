@extends('layouts.layoutMain')

@section ('head')
    @parent
    <link href={{ asset("assets/site/css/Cosmetologies_Style.css") }} rel="stylesheet" />
@endsection



@section ('navbar')
    <a id="tabStart"></a>
    <div class="navbar-default" role="navigation" id="myNavbar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <ul class="navbar-nav" style="">
                        <li class="nav-item" >
                            <a class="nav-link" href="{{route('home')}}">На главную</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Скрытое поле меню. При прокрутке становится видимым -->
    <div class="row" id="navHidden" style="visibility: hidden">
        <div class="navbar-default" role="navigation" id="myNavbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <ul class="navbar-nav" style="">
                            <li class="nav-item" >
                                <a class="nav-link" href="{{route('home')}}">На главную</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section ('content')
    <br>
    @foreach ($cosmetologies as $cosmetolog)
        <div class="container">
            <div class="panel panelCosmetologies">
                      <div class="row">
                            <div class="col-md-4 col-md-offset-0" >

                                @if(Storage::disk('public')->exists("/assets/img/cosmetologies/".$cosmetolog->id."/main/main.jpg") )
                                    <a href="{{('cosmetolog/'.$cosmetolog->id)}}">
                                        <img class="imgCosmetolog"  src={{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/main/main.jpg") }}  />
                                    </a>
                                @else
                                    <img class='center-block img-thumbnail imgCosmetolog'
                                         src={{ asset("assets/site/img/nonFoto.png") }} >
                                @endif
                            </div>
                            <div class="col-md-4">

                                <a href="{{('cosmetolog/'.$cosmetolog->id)}}" >
                                    <h1>{{$cosmetolog->title}}</h1>
                                </a>
                                <p>{{$cosmetolog->address}}</p>
                                <p>{!!$cosmetolog->work_schedule!!}</p>
                                <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp&nbsp{{$cosmetolog->views_numb}}</p>
                            </div>
                            <div class="col-md-4 col-md-offset-0" >
                                @if(Storage::disk('public')->exists("/assets/img/cosmetologies/".$cosmetolog->id."/logo/logo.png") )
                                    <a href="{{('cosmetolog/'.$cosmetolog->id)}}">
                                        <img class="imgLogo" src={{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/logo/logo.png") }}  />
                                    </a>
                                @endif
                            </div>
                      </div>
             </div>
        </div>
    @endforeach
    <div class="container">
     {{$cosmetologies ->links('layouts.paginate')}}
    </div>
@endsection
