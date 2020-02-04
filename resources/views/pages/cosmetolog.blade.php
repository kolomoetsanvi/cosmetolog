@extends('layouts.layoutMain')

@section ('head')
    @parent
    <link href={{ asset("assets/site/css/CosmetologStyle.css") }} rel="stylesheet" />

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


    <div class="row" id="rowMain" >

         {{-- левая часть строки - фото-галерея--}}
         <div class="col-md-6 col-md-offset-1">
        {{--======================Карусель==========================--}}
            <div class="row-fluid">
                 <div class="carousel carouselMain slide carousel-fade" data-ride="carousel" id="myCarousel">
                       <div class="carousel-inner">
                            <div class="item active">
                                  @if(Storage::disk('public')->exists("/assets/img/cosmetologies/".$cosmetologie->id."/main/main.jpg") )
                                       <div class="text-center divImgKarusel">
                                            <img class='img-thumbnail center-block'
                                                 src={{ asset("storage/assets/img/cosmetologies/".$cosmetologie->id."/main/main.jpg") }} />
                                       </div>
                                  @else
                                    <div class="text-center divImgKarusel">
                                        <img class='img-thumbnail center-block'
                                             src={{ asset("assets/site/img/nonFoto.jpg") }} />
                                    </div>
                                  @endif
                            </div> <!-- Item Active -->

                           @foreach ($filesImgInterior as $img)
                               <div class="item">
                                     <div class="text-center divImgKarusel">
                                           <img class='img-thumbnail center-block'
                                                src="{{ asset("storage/".$img) }}" />
                                       </div>
                               </div> <!-- Item Active -->
                           @endforeach

                     </div><!-- carousel-inner -->
                 </div><!-- #myCarousel -->
            </div><!-- /.row -->

             <div class="row-fluid text-center" id="rowImgMin">
                 @if(Storage::disk('public')->exists("/assets/img/cosmetologies/".$cosmetologie->id."/main/main.jpg") )
                     <a href="#" id="0"><img src="{{ asset("storage/assets/img/cosmetologies/".$cosmetologie->id."/main/main.jpg") }}" ></a>
                 @else
                     <a href="#" id="0"><img src="{{  asset("assets/site/img/nonFoto.jpg") }}" ></a>
                 @endif
                     @for ($i = 0; $i < count($filesImgInterior); $i++)
                         <a href="#" id="{{$i+1}}"><img src="{{ asset("storage/".$filesImgInterior[$i]) }}" ></a>
                     @endfor
             </div ><!-- /.row -->
         </div >


         <script>
                            $(document).ready(function() {
                                //функция запускает карусель с определенного слайда
                                var myCarusel	= function(num) {
                                    $('.carouselMain').carousel(num);
                                    $('.carouselMain').carousel({
                                        interval: 100
                                    })
                                }
                                //запускаем карусель с нулевого слайда
                                $(function(){
                                    myCarusel(0);
                                });

                                //при нажатии на картинку в низу запускаем нужный слайд карусели
                                $(function(){
                                    $('a', "#rowImgMin").on('click', function(e){

                                        num = Number.parseInt($(this).attr('id'));
                                        myCarusel(num);

                                    });
                                });
                            });
          </script>
         {{--=======================================================================--}}


        {{-- правая часть: контактные данные--}}
        <div class="col-md-4">
            <div class="panel panelCosmetologMain">
                <!-- Тело панели / формы ввода -->
                <div class="panel-body"  >
                    <div class="row">
                        <div class="col-md-9 text-left">
                            <h1 class="warningColor">{{$cosmetologie->title}}</h1>
                        </div>
                        @if(Storage::disk('public')->exists("/assets/img/cosmetologies/".$cosmetologie->id."/logo/logo.png") )
                          <div class="col-md-3 text-right">
                              <img class="img-logoSite" src="{{ asset("storage/assets/img/cosmetologies/".$cosmetologie->id."/logo/logo.png") }}" >
                         </div>
                        @endif
                    </div>
                    <p>{{$cosmetologie->address}}</p>
                    <p>{!!$cosmetologie->work_schedule!!}</p>
                    <p>{{$cosmetologie->phone}}</p>


                    <ul class="logoSeti">
                        <li><a href="{{$cosmetologie->site}}">{{$cosmetologie->site}}</a></li>
                        <li><a href="{{$cosmetologie->vk}}"> <img class='img-logoSite'
                                                                  src="{{ asset("assets/site/img/logoSite/vk.png") }}" /></a></li>
                        <li><a href="{{$cosmetologie->ok}}"><img class='img-logoSite'
                                                                 src="{{ asset("assets/site/img/logoSite/ok.png") }}" /></a></li>
                        <li><a href="{{$cosmetologie->fb}}"><img class='img-logoSite'
                                                                 src="{{ asset("assets/site/img/logoSite/fb.png") }}" /></a></li>
                        <li><a href="{{$cosmetologie->inst}}"><img class='img-logoSite'
                                                                   src="{{ asset("assets/site/img/logoSite/inst.png") }}" /></a></li>
                    </ul>

                    <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp&nbsp{{$cosmetologie->views_numb}}</p>

                </div><!--<div class="panel-body" >-->
            </div><!--<div class="panel " >-->

        </div>
    </div>


{{--    ======================================================================================    --}}
{{--    ======================================================================================    --}}
{{--    ======================================================================================    --}}


{{--    Строка с картами и кратким описанием --}}
     <div class="row" id="rowWithMap" >

          <div class="col-md-6">
             {{--краткое описание--}}
             <div class="row" >
                  <div id="divTextBrief">
                        <p>{{$cosmetologie->brief}}</p>
                  </div><!--<div class="panel-body" id="Add">-->
             </div> <!--<div class="row">-->
          </div> {{--   <div class="col-md-6">--}}

         <div class="col-md-6">
              {{--Яндекс карты--}}
              <div class="row" >
                  <div class="text-center" id="divMap" >
                      <a href="" >
                       {!! $cosmetologie->maps !!}
                      </a>
                  </div><!--<div class="panel-body" id="Add">-->
              </div> <!--<div class="row">-->
         </div> {{--   <div class="col-md-6">--}}
     </div><!--<div class="row">-->


    {{--    ======================================================================================    --}}
    {{--    ======================================================================================    --}}
    {{--    ======================================================================================    --}}

            {{--фото сотрудников--}}
    @if(count($cosmetologie->cosmetologiesPersonnel) > 0)
            <div class="row" id="rowWithPersonnel" >
                <div class="row text-center" id="rowWithPersonnelText">
                    <h2 class="center-block">Сотрудники</h2>
               </div><!--<div class="row">-->


                {{--=======================================================================--}}
                {{--======================Карусель==========================--}}
                <div class="row-fluid">

                    <div class="carousel slide carousel-fade" data-ride="carousel" id="myCarouselPersonnel">
                        <div class="carousel-inner">

                            @for($i = 0; $i < count($cosmetologie->cosmetologiesPersonnel); $i++)
                                @if($i == 0)
                                    <div class="item active">
                                @else
                                     <div class="item">
                                 @endif

                                      <div class="row"  >

                                               @for($j = 0; $j < 5; $j++)
                                                     @if($i+$j < count($cosmetologie->cosmetologiesPersonnel))
                                                       @if($j == 0)   <div class="col-md-2 col-md-offset-1 text-center">
                                                       @else   <div class="col-md-2 text-center">
                                                       @endif

                                                            <div class="thumbnail thumbnailPersonnel center-block">
                                                                <div >
                                                                    <a href="#" >
                                                                        @if(Storage::disk('public')->exists("/assets/img/personnel/".$cosmetologie->cosmetologiesPersonnel[$i+$j]->id."/personnel.jpg") )
                                                                            <img class='center-block img-personnel'
                                                                                 src={{ asset("storage/assets/img/personnel/".$cosmetologie->cosmetologiesPersonnel[$i+$j]->id."/personnel.jpg") }} >
                                                                        @else
                                                                            <img class='center-block img-personnel'
                                                                                 src={{ asset("assets/site/img/nonPeopleFoto.jpg") }} >
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="caption">
                                                                    <div class="text-center">
                                                                        <p >{{ $cosmetologie->cosmetologiesPersonnel[$i+$j]->surname}}    </p>
                                                                        </p>{{ $cosmetologie->cosmetologiesPersonnel[$i+$j]->name}}       </p>
                                                                        </p>{{ $cosmetologie->cosmetologiesPersonnel[$i+$j]->patronymic}} </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                       </div>
                                                    @endif
                                               @endfor {{--  @for $j--}}
                                       </div>
                                 </div><!-- /Slide1 -->
                            @endfor {{--  @for $i--}}

                        </div> {{--  <div class="carousel-inner">--}}

                        <div class="control-box">
                               <a data-slide="prev" href="#myCarouselPersonnel" class="carousel-control left">‹</a>
                               <a data-slide="next" href="#myCarouselPersonnel" class="carousel-control right">›</a>
                        </div><!-- /.control-box -->

                        </div><!-- /#myCarouselPersonnel -->
                </div><!-- /.row -->
                    {{--======================Карусель==========================--}}
                    {{--=======================================================================--}}
          </div><!--<div class="row">-->
     @endif

    {{--    ======================================================================================    --}}
    {{--    ======================================================================================    --}}
    {{--    ======================================================================================    --}}

    {{--фото работ--}}
    @if(count($filesImgWorks) > 0)
    <div class="row" id="rowWithworks" >
                 <div class="row text-center" id="rowWithWorksText">
                     <h2 class="center-block">Работы</h2>
                 </div><!--<div class="row">-->

                <div class="container" >
                <div class="row" >
{{--                    <ul class="fotoWorks">--}}
                        @foreach ($filesImgWorks as $fW)
{{--                            <li>--}}
{{--                                <div style="float:left; margin-right: 10px">--}}
                                <div class="col-md-3 divImgWorks">
                                    <img class='img-works thumbnail'
                                         src="{{ asset("storage/".$fW) }}" />
                                </div>
{{--                            </li>--}}
                        @endforeach
{{--                    </ul>--}}
                </div><!--<div class="row">-->
                </div><!--<div class="row">-->
    </div>
    @endif

     {{--    ======================================================================================    --}}
     {{--    ======================================================================================    --}}
     {{--    ======================================================================================    --}}

    {{--акционные предложения--}}
    @if(count($cosmetologie->promotion) > 0)
         <?php $counter = 0 ?> <!--счетчик акций-->
         @for($i = 0; $i <  count($cosmetologie->promotion); $i++)
                 @if($cosmetologie->dateCmp($cosmetologie->promotion[$i]->end))
                     <?php $counter++?>
{{--                 ========================================--}}
{{--                 Если есть хотя бы одна действующая акция--}}
                     @if($counter == 1)
                         <div class="row" id="rowWithPromotion" >
                                 <div class="row text-center" id="rowWithPromotionText">
                                     <h2 class="center-block">Акции</h2>
                                 </div><!--<div class="row">-->

                                 <div class="row text-center" id="rowWithPromotionMaterial">
                                     <div class="row">
                     @endif
{{--                 ========================================--}}
{{--                     Строка с 4-я акционными предложениями (действующими)--}}
                      @if($counter < 5)
                                             <div class="col-md-3 text-center">
                                                 <div class="panel panel-primary panelPromotion center-block">
                                                     <div class="panel-heading">
                                                         @if(Storage::disk('public')->exists("/assets/img/promotion/".$cosmetologie->promotion[$i]->id.".jpg") )
                                                             <img class='center-block img-promotion'
                                                                  src={{ asset("storage/assets/img/promotion/".$cosmetologie->promotion[$i]->id.".jpg") }} >
                                                         @else
                                                             <img class='center-block img-promotion'
                                                                  src={{ asset("assets/site/img/nonPromotion.jpg") }} >
                                                         @endif
                                                     </div>
                                                     <div class="panel-body">
                                                         <div class="row text-center" id="rowWithNewCost">
                                                             <p >Новая цена: {{ $cosmetologie->promotion[$i]->new_cost}}</p>
                                                         </div>
                                                         <div class="text-center" id="textService">
                                                             <h4>{{$cosmetologie->promotion[$i]->service->title}}</h4>
                                                         </div>
                                                     </div>
                                                     <div class="panel-footer">
                                                         <div class="text-center" id="textDate">
                                                             </p>Действует с: {{ $cosmetologie->promotion[$i]->start}}</p>
                                                             </p>по: {{ $cosmetologie->promotion[$i]->end}}</p>
                                                         </div>
                                                     </div>
                                                 </div>

                                             </div>{{--   <div class="col-md-3 text-center">--}}
                      @endif  {{--    @if($counter < 4)--}}



                        @if($counter >= 5)
                                @if($counter == 5)
                                         </div>
                                        <div class="row">
                                             <button id="btnAllPromotion" class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapsePromotion" aria-expanded="false" aria-controls="collapsePromotion">
                                                   Показать все акционные предложения <span class="glyphicon glyphicon-th-list"></span>
                                             </button>

                                             <div class="collapse" id="collapsePromotion">
                                @endif
                                                             <div class="col-md-3 text-center">
                                                                 <div class="panel panel-primary panelPromotion center-block">
                                                                     <div class="panel-heading">
                                                                         @if(Storage::disk('public')->exists("/assets/img/promotion/".$cosmetologie->promotion[$i]->id.".jpg") )
                                                                             <img class='center-block img-promotion'
                                                                                  src={{ asset("storage/assets/img/promotion/".$cosmetologie->promotion[$i]->id.".jpg") }} >
                                                                         @else
                                                                             <img class='center-block img-promotion'
                                                                                  src={{ asset("assets/site/img/nonPromotion.jpg") }} >
                                                                         @endif
                                                                     </div>
                                                                     <div class="panel-body">
                                                                         <div class="row text-center" id="rowWithNewCost">
                                                                             <p >Новая цена: {{ $cosmetologie->promotion[$i]->new_cost}}</p>
                                                                         </div>
                                                                         <div class="text-center" id="textService">
                                                                             <h4>{{$cosmetologie->promotion[$i]->service->title}}</h4>
                                                                         </div>
                                                                     </div>
                                                                     <div class="panel-footer">
                                                                         <div class="text-center" id="textDate">
                                                                             </p>Действует с: {{ $cosmetologie->promotion[$i]->start}}</p>
                                                                             </p>по: {{ $cosmetologie->promotion[$i]->end}}</p>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>   <!-- <div class="col-md-3 text-center">-->
                      @endif    {{--   @if($counter >= 5)--}}





                 @endif{{--  @if($cosmetologie->dateCmp($cosmetologie->promotion[$i]->end))--}}
         @endfor {{--  @for $i--}}
{{--     ========================================--}}
{{--     Если действующих акций > 4 закрываем открытие скрытого поля--}}
         @if($counter > 4)
                 </div> <!--   <div class="collapse" id="collapsePromotion">-->
              </div>
         @elseif($counter > 0)
                </div>
         @endif
{{--     Если есть хотя бы одна действующая акция закрываем открытие строки с акциями--}}
         @if($counter > 0)
                    </div><!--<div class="row" id="rowWithPromotion" >-->
             </div><!-- <div class="row text-center" id="rowWithPromotionMaterial">-->
         @endif
    @endif<!--if(count($cosmetologie->promotion) > 0)-->

                    {{--    ======================================================================================    --}}
     {{--    ======================================================================================    --}}
     {{--    ======================================================================================    --}}

      {{--прайс--}}
      @if(count($cosmetologie->price) > 0)
       <div class="row" id="rowWithPrice" >

           <div class="row text-center" id="rowWithPriceText">
               <h2 class="center-block">Прайс</h2>
           </div><!--<div class="row">-->

           <div class="row" >
                 <div class="col-md-8 col-md-offset-2">
                        <table class='table table-striped table-bordered'>
                                        <thead>
                                            <tr>
                                                <td>Услуга</td><td>Стоимость, &nbsp руб.</td>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        @foreach ($cosmetologie->price as $priceItem)
                                            <tr>
                                               <td>{{$priceItem->service->title}}</td>
                                                <td>{{$priceItem->cost}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                        </table>
                 </div>
            </div><!--<div class="row">-->

       </div><!--<div class="row">-->
        @endif

                    {{--    Модальное окно по клику на карту --}}
                    <script>
                        modalWindowNonReload();
                    </script>

                    <script>
                        $(document).ready(function() {
                            $(function(){
                                $('a', "#divMap").on('click', function(e){
                                    event.preventDefault();
                                    $('#myModalNonReload').modal('show')
                                });
                            });
                        });
                    </script>


@endsection






