@extends('layouts.layoutMain')

@section ('head')
    @parent
    <link href="{{ asset("assets/site/css/IndexStyle.css") }}" rel="stylesheet" />
{{--    <script src="{{ asset("assets/site/js/lines.js") }}" type="text/javascript"></script>--}}
@endsection


@section ('navbar')
    <a id="tabStart"></a>
    <div class="navbar-default" role="navigation" id="myNavbar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <ul class="navbar-nav" style="">
                        <li class="nav-item" >
                            <a class="nav-link" href="#tabStart">Начальная</a>
                        </li>

                        <li class="nav-item" >
                            <a class="nav-link" href="#tabCosmo">Косметологи</a>
                        </li>

                        <li class="nav-item" >
                            <a class="nav-link" href="#tabArticle">Статьи</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Скрытое поле меню. При прокрутке становится видимым -->
    <div class="row" id="navHidden" style="visibility: hidden">
    <div class="navbar-default" role="navigation" >
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <ul class="navbar-nav" style="">
                        <li class="nav-item" >
                            <a class="nav-link" href="#tabStart">Начальная</a>
                        </li>

                        <li class="nav-item" >
                            <a class="nav-link" href="#tabCosmo">Косметологи</a>
                        </li>

                        <li class="nav-item" >
                            <a class="nav-link" href="#tabArticle">Статьи</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
 @endsection



@section ('content')
    <div class="row" id="rowMainLine" >
        <canvas id="lines">
        </canvas>
        <div class="row" id="inner" >
            <div class="col-md-12">
                <div id="blur">
                    <p class="headText">Косметология</p>
                </div>
                <p class="headText2">in your city </p>
            </div>
        </div>

    </div>


{{--=======================================================================--}}
{{--    Форма поиска косметологов--}}
{{--=======================================================================--}}

    <div class="row" >
        <a id="tabCosmo"></a>
        <div class="col-md-8 col-md-offset-2" id="searchCosmetolog" >
            <form method="post" action="{{route('cosmetologies')}}" >
                {{ csrf_field() }}
                <div class="row" style="margin-top: 10px; margin-bottom: 10px">
                    <div class="col-md-3">
                        <label class="labelSearchCosmetolog" for="citiSelect">Город:</label>
                        <select class="form-control" name="citiSelect" id="citiSelect" size="1" >
                            <option style="margin: auto" value="0">Все</option>
                            @foreach ($cities as $citie)
                                <option style="margin: auto" value="{{ $citie->id}}">{{ $citie->citie}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="labelSearchCosmetolog" for="districtSelect">Район:</label>
                        <select class="form-control" name="districtSelect" id="districtSelect" size="1">
                            <option style="margin: auto" value="0">Все</option>
                            @foreach ($districts as $district)
                                <option style="margin: auto" value="{{ $district->id}}">{{ $district->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="labelSearchCosmetolog" for="serviceSelect">Услуги:</label>
                        <select class="form-control" name="serviceSelect" id="serviceSelect" size="1"  >
                            <option style="margin: auto" value="0">Все</option>
                            @foreach ($cervices as $cervice)
                                <option style="margin: auto" value="{{ $cervice->id}}">{{ $cervice->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-info form-control" type="submit" name="btCosmetolog" id="btCosmetolog" value="Поиск"
                               style="margin-top: 2em"
                        />
                    </div>
                </div>
            </form>
        </div>
    </div>

{{--=======================================================================--}}
{{--    Ссылка на карты --}}
{{--=======================================================================--}}
    <div class="row" id="rowMapDiv" >
        <div class="col-md-4 col-md-offset-2  text-center "  >
            <h3>Все косметологические салоны<br>
                и косметологи Вашего города<br>
                собраны на одном ресурсе</h3>
            <br>
            <p>Задайте параметры поиска<br>
               или воспользуйтес онлайн картами<br>
               для поиска.</p>
        </div>
        <div class="col-md-4 text-left"  >
            <a href="" >
                <img src="{{ asset("assets/site/img/mapY.png") }}" class="imgMapY"  alt="Яндекс карты">
            </a>
        </div>
    </div>




{{--=======================================================================--}}
{{--    Форма поиска статей--}}
{{--=======================================================================--}}
<a id="tabArticle"></a>
<div class="row" id="rowAfterMap">
    <div class="row"  id="rowArticleKarusel" >
        <div class="col-md-8 text-center "  >
            {{--=======================================================================--}}
            {{--======================Карусель==========================--}}
                <div class="row-fluid">

                        <div class="carousel slide carousel-fade" data-ride="carousel" id="myCarousel">
                            <div class="carousel-inner">

                               @for($i = 0; $i < count($articles); $i=$i+2)
                                    @if($i == 0)
                                        <div class="item active">
                                    @else
                                        <div class="item">
                                    @endif

                                    <div class="row" id="rowKaruselItem" >
                                        <div class="col-md-6 text-center">
                                            @if($i < count($articles))
                                            <div class="thumbnail center-block">
                                                <div class="divImgThumbnail">
                                                    <a href="#" >
                                                        @if(Storage::disk('public')->exists("/assets/img/article/".$articles[$i]->id."/main.jpg") )
                                                            <img class='center-block img-thumbnail'
                                                                         src={{ asset("storage/assets/img/article/".$articles[$i]->id."/main.jpg") }} >
                                                        @else
                                                            <img class='center-block img-thumbnail'
                                                                 src={{ asset("assets/site/img/nonFoto.png") }} >
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="caption">
                                                    <div class="divTextThumbnail">
                                                        <h4>{{$articles[$i]->title}}</h4>
                                                    </div>
                                                    <a class="btn btn-mini" href="{{('article/'.$articles[$i]->id)}}">&raquo; Читать полностью</a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-center">
                                            @if($i+1 < count($articles))
                                            <div class="thumbnail center-block">
                                                <div class="divImgThumbnail">
                                                    <a href="#" >
                                                        @if(Storage::disk('public')->exists("/assets/img/article/".$articles[$i+1]->id."/main.jpg") )
                                                            <img class='center-block img-thumbnail'
                                                                 src={{ asset("storage/assets/img/article/".$articles[$i+1]->id."/main.jpg") }} >
                                                        @else
                                                            <img class='center-block img-thumbnail'
                                                                 src={{ asset("assets/site/img/nonFoto.png") }} >
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="caption">
                                                    <div class="divTextThumbnail">
                                                         <h4>{{$articles[$i+1]->title}}</h4>
                                                    </div>
                                                    <a class="btn btn-mini" href="{{('article/'.$articles[$i+1]->id)}}">&raquo; Читать полностью</a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- /Slide1 -->
                              @endfor

                            </div>

                            <div class="control-box">
                                <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
                                <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
                            </div><!-- /.control-box -->

                        </div><!-- /#myCarousel -->

                </div><!-- /.row -->





            <script>
                // Carousel Auto-Cycle
                $(document).ready(function() {
                    $('.carousel').carousel({
                        interval: 4000
                    })
                });
            </script>
           {{--=======================================================================--}}


        </div>
        <div class="col-md-4 text-center" id="divArticleText" >

            <h3>Читайте тематические статьи.</h3>
            <br>
            <p>Следите за тенденциями в косметолгии.<br>
                Смотрите первыми презентации новинок<br>
                профессиональной косметики.</p>

        </div>


    </div>


    <div class="row"  id="rowsearchArticle" >
        <div class="col-md-8 col-md-offset-2" id="searchArticle">
            <div class="col-md-3" id="colbtArticles">
                <form method="post" action="{{route('articles')}}" >
                {{ csrf_field() }}
                    <div class="row">
                        <input class="btn btn-info  form-control" type="submit" name="btArticles" id="btArticles" value="Загрузить все статьи"/>
                    </div>
                 </form>
            </div>
            <div class="col-md-9">
                <form method="post" action="{{route('articlesSearch')}}" >
                    {{ csrf_field() }}
                    <div class="input-group">
						<span class="input-group-addon" id="basic-addon1">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</span>
                        <input type="text" class="form-control" id="inArticlesSearch" name="inArticlesSearch" placeholder="Введите параметр поиска">
                        <span class="input-group-btn" id="basic-addon2">
							<input  class="btn btn-info form-control" type="submit" name="btArticles" id="btArticles" value="Поиск"/>
						</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--    Модальное окно по клику на карту --}}
    <script>
        modalWindowNonReload();
    </script>

    <script>
        $(document).ready(function() {
            $(function(){
                $('a', "#rowMapDiv").on('click', function(e){
                    event.preventDefault();
                    $('#navHidden').css('visibility', 'hidden');
                    $('#myModalNonReload').modal('show')
                });
            });
        });
    </script>

@endsection
