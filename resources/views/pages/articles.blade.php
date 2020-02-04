@extends('layouts.layoutMain')

@section ('head')
    @parent
    <link href={{ asset("assets/site/css/Articles_Style.css") }} rel="stylesheet" />
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
    @foreach ($articles as $article)
        <div class="container">
            <div class="panel panelArticles">
                  <div class="row">
                        <div class="col-md-4" >
                            @if(Storage::disk('public')->exists("/assets/img/article/".$article->id."/main.jpg") )
                                <a href="{{('article/'.$article->id)}}">
                                    <img class="imgArticles" src={{ asset("storage/assets/img/article/".$article->id."/main.jpg") }}  />
                                </a>
                            @else
                                <img class='center-block img-thumbnail imgArticles'
                                     src={{ asset("assets/site/img/nonFoto.png") }} >
                            @endif
                        </div>
                        <div class="col-md-7">
                            <a href="{{('article/'.$article->id)}}"><h2>{{$article->title}}</h2> </a>
                            <br>
                            <p>{{str_limit(strip_tags($article->content), 256, '[...]')}}</p>

                        </div>
                        <div class="col-md-1">
                              <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp&nbsp{{$article->views_numb}}</p>
                         </div>
                  </div>
            </div>
        </div>
    @endforeach
    {{$articles ->links('layouts.paginate')}}

@endsection
