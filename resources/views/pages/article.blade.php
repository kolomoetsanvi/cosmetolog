@extends('layouts.layoutMain')

@section ('head')
    @parent
    <link href={{ asset("assets/site/css/ArticleStyle.css") }} rel="stylesheet" />
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

    {{--Статья--}}
    <section >
        <div class="row" >
            {{--                левая часть строки - фото--}}
            <div class="col-md-8 col-md-offset-2">
                   <div class="panel panelArticle">
                       <div class="row text-right" id="rowViews">
                             <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp&nbsp{{$article->views_numb}}</p>
                       </div>
                       <div class="row text-center" id="rowTitle">
                            <h1>{{$article->title}}</h1>
                       </div>
                       <div class="row text-center" id="rowImg">
                           @if(Storage::disk('public')->exists("/assets/img/article/".$article->id."/main.jpg") )
                               <img class='img-thumbnail'
                                    src={{ asset("storage/assets/img/article/".$article->id."/main.jpg") }} />
                           @endif
                       </div>
                       <div class="row" id="rowContent">
                             {!! $article->content !!}
                       </div>
                    </div><!--<div class="panel " >-->
            </div>
        </div> <!--<div class="row">-->
    </section >

@endsection

