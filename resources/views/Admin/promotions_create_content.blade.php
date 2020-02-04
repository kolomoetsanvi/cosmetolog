{{--используется для создания и редактирования акций--}}
{{--если есть в запросе id - редактирование, нет - создание--}}
<div id="content-page" class="content group">
    <div class="container">
        <div class="hentry group">
            <h2>{{$strTitle}}</h2>


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


            <form method="post" class="form" enctype="multipart/form-data" action="{{ (isset($promotion->id)) ?  route('admin.promotions.update', ['id'=>$promotion->id]) :  route('admin.promotions.store') }}" >
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <ul style=" list-style-type: none">



                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Косметолог:</span>
                                </label>
                                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i> </span>
                                    <select class="form-control" id="selectCosmetolog" name="selectCosmetolog" size="1" >
                                        @foreach($cosmetologies as $cosmetolog)
                                            @if(isset($promotion->cosmetologies_id) && $cosmetolog->id == $promotion->cosmetologies_id )
                                                <option selected="selected" value="{{$cosmetolog->id}}">{{$cosmetolog->title}}</option>
                                            @else
                                                <option value="{{$cosmetolog->id}}">{{$cosmetolog->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </br> </br>
                                </div>
                            </li>


                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Услуга:</span>
                                </label>
                                <div class="input-prepend" id="divServicesSelect"><span class="add-on"><i class="icon-user"></i> </span>
                                    <select class="form-control" id="selectService" name="selectService" size="1" >
                                        @foreach($services as $service)
                                            @if(isset($promotion->services_id) && $service->id == $promotion->services_id )
                                                <option selected="selected" value="{{$service->id}}">{{$service->title}}</option>
                                            @else
                                                <option value="{{$service->id}}">{{$service->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </br> </br>
                                </div>
                            </li>



                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Начало:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="date" name="start" id="start" value="{{(isset($promotion->start)) ? $promotion->start : old('start')}}" >
                                    </br>
                                </div>
                            </li>


                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Окончание:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="date" name="end" id="end" value="{{(isset($promotion->end)) ? $promotion->end : old('end')}}" >
                                    </br>
                                </div>
                            </li>

                            <li class="textarea-field">
                                <label for="message-contact-us">
                                    </br> <span class="label">* Новая стоимость:</span>

                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="new_cost" id="new_cost" value="{{(isset($promotion->new_cost)) ? $promotion->new_cost : old('new_cost')}}" placeholder="Введите новую стоимость" >
                                    </br>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul style=" list-style-type: none">
                            @if($img)
                                <li class="textarea-field">
                                    <label for="message-contact-us">
                                        </br>    <span class="label">Текущее изображение:</span>
                                        </br>
                                    </label>
                                    <img style="max-height: 360px" src={{ asset("storage/assets/img/promotion/".$promotion->id.".jpg") }}  />
                                    <input  class="hidden" type="hidden" name="old_image" id="old_image" value="{{ asset("storage/assets/img/promotion/".$promotion->id.".jpg") }}"  >
                                    </br>
                                    <input class="form-check-input" type="checkbox" value="deleteCheck" id="deleteCheck" name="deleteCheck">
                                    <label class="form-check-label" for="deleteCheck">Удалить изображение</label>
                                    </br></br>
                                </li>

                            @endif


                            <li class="textarea-field">
                                <label for="name-contact-us">
                                    <span class="label">Изображение:</span>
                                </label>
                                <div class="input-prepend">
                                    <input type="file" class="filestyle data-buttonText" name="image" id="image" value="Выберите файл">
                                </div>

                            </li>

                            <li class="submit-button">
                                 </br></br>
                                <input class="btn btn-success" type="submit" value="Сохранить" />
                            </li>

                        </ul>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(function(){
            //При загрузке страницы загружаем услуги которые предоставляет комсметолог
            var cosmetologies  =  $('#selectCosmetolog').val();
            var service  =  $('#selectService').val();

            $.ajax({
                url: '{{ route('admin.promotions.changeCosmetologie') }}',
                type: "POST",
                data: {id:cosmetologies, service:service},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#divServicesSelect').html(data);
                },
                error: function (msg) {
                    alert('Ошибка');
                }

            });

            //-----------------------------------------------------------
            // Выбор косметолога
            //При выборе косметолога  загружаем услуги которые предоставляет комсметолог
            $('#selectCosmetolog').on('change', function(){
                //получаем данные из select
                var cosmetologies  =  $('#selectCosmetolog').val();
                $.ajax({
                    url: '{{ route('admin.promotions.changeCosmetologie') }}',
                    type: "POST",
                    data: {id:cosmetologies},
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                         $('#divServicesSelect').html(data);
                    },
                    error: function (msg) {
                        alert('Ошибка');
                    }

                });
            });

        });
    });
</script>



