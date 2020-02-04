{{--используется для создания и редактирования сотрудников--}}
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


            <form method="post" class="form" enctype="multipart/form-data" action="{{ (isset($person->id)) ?  route('admin.personnel.update', ['id'=>$person->id]) :  route('admin.personnel.store') }}" >
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <ul style=" list-style-type: none">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Фамилия:</span>
                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="surname" id="surname" value="{{(isset($person->surname)) ?$person->surname : old('surname')}}" placeholder="Введите фамилию" >
                                    </br>
                                </div>
                            </li>

                            <li class="textarea-field">
                                <label for="message-contact-us">
                                    </br> <span class="label">* Имя:</span>

                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="name" id="name" value="{{(isset($person->name)) ?$person->name : old('name')}}" placeholder="Введите имя" >
                                    </br>
                                </div>
                            </li>


                            <li class="textarea-field">
                                <label for="message-contact-us">
                                    </br> <span class="label">Отчество:</span>

                                </label>
                                <div class="input-prepend">
                                    <input class="form-control" type="text" name="patronymic" id="patronymic" value="{{(isset($person->patronymic)) ?$person->patronymic : old('patronymic')}}" placeholder="Введите отчество" >
                                    </br>
                                </div>
                            </li>

                            <li class="submit-button">
                                </br></br>
                                <input class="btn btn-success" type="submit" value="Сохранить" />
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul style=" list-style-type: none">
                            @if($img)
                                <li class="textarea-field">
                                    <label for="message-contact-us">
                                        </br>    <span class="label">Текущее фото:</span>
                                        </br>
                                    </label>
                                    <img style="max-height: 360px" src={{ asset("storage/assets/img/personnel/".$person->id."/personnel.jpg") }}  />
                                    <input  class="hidden" type="hidden" name="old_image" id="old_image" value="{{ asset("storage/assets/img/personnel/".$person->id."/personnel.jpg") }}"  >
                                    </br>
                                    <input class="form-check-input" type="checkbox" value="deleteCheck" id="deleteCheck" name="deleteCheck">
                                    <label class="form-check-label" for="deleteCheck">Удалить фото</label>
                                    </br></br>
                                </li>

                            @endif


                            <li class="textarea-field">
                                <label for="name-contact-us">
                                    <span class="label">Фото:</span>
                                </label>
                                <div class="input-prepend">
                                    <input type="file" class="filestyle data-buttonText" name="image" id="image" value="Выберите файл">
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



