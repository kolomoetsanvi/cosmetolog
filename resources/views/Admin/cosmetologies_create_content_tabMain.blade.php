
<div class="row">
    <div class="col-md-6">
        <ul style=" list-style-type: none">

            <li class="text-field">
                <label for="title">
                    </br>  <span class="label">* Название:</span>
                </label>
                <div class="input-prepend">
                    <input class="form-control" type="text" name="title" id="title" value="{{(isset($cosmetolog->title)) ?$cosmetolog->title : old('title')}}" placeholder="Введите название" >
                    </br>
                </div>
            </li>


            <li class="text-field">
                <label for="selectCities">
                    </br>  <span class="label">* Город:</span>
                </label>
                <div class="input-prepend">
                    <select class="form-control" id="selectCities" name="selectCities" size="1" >
                        @foreach($cities as $city)
                            @if(isset($cosmetolog->cities_id) && $cosmetolog->cities_id == $city->id )
                                <option selected="selected" value="{{$city->id}}">{{$city->citie}}</option>
                            @else
                                <option value="{{$city->id}}">{{$city->citie}}</option>
                            @endif
                        @endforeach
                    </select>
                    </br> </br>
                </div>
            </li>



            <li class="text-field">
                <label for="selectDistricts">
                    </br>  <span class="label">* Район:</span>
                </label>
                <div class="input-prepend">
                    <select class="form-control" id="selectDistricts" name="selectDistricts" size="1" >
                        @foreach($districts as $district)
                            @if(isset($cosmetolog->districts_id) && $cosmetolog->districts_id == $district->id )
                                <option selected="selected" value="{{$district->id}}">{{$district->title}}</option>
                            @else
                                <option value="{{$district->id}}">{{$district->title}}</option>
                            @endif
                        @endforeach
                    </select>
                    </br> </br>
                </div>
            </li>


            <li class="textarea-field">
                <label for="address">
                    </br> <span class="label">* Адрес:</span>

                </label>
                <div class="input-prepend">
                      <textarea  class="form-control"  name="address" id="address" rows="2" >
                          {{(isset($cosmetolog->address)) ? $cosmetolog->address : old('address')}}
                      </textarea>
                    </br></br>
                </div>
            </li>


            <li class="text-field">
                <label for="phone">
                    </br>  <span class="label">Телефон:</span>
                </label>
                <div class="input-prepend">
                    <input class="form-control" type="text" name="phone" id="phone" value="{{(isset($cosmetolog->phone)) ?$cosmetolog->phone : old('phone')}}" placeholder="Введите название" >
                    </br>
                </div>
            </li>


            <li class="textarea-field">
                <label for="work_schedule">
                    </br> <span class="label">График работы:</span>

                </label>
                <div class="input-prepend">
                      <textarea  class="form-control"  name="work_schedule" id="work_schedule" rows="3" >
                          {{(isset($cosmetolog->work_schedule)) ? $cosmetolog->work_schedule : old('work_schedule')}}
                      </textarea>
                    </br></br>
                </div>
            </li>


            <li class="textarea-field">
                <label for="brief">
                    </br> <span class="label">* Описание:</span>

                </label>
                <div class="input-prepend">
                      <textarea  class="form-control"  name="brief" id="brief" rows="5" >
                          {{(isset($cosmetolog->brief)) ? $cosmetolog->brief : old('brief')}}
                      </textarea>
                    </br></br>
                </div>
            </li>


            <li class="textarea-field">
                <label for="maps">
                    </br> <span class="label">Яндекс карты:</span>

                </label>
                <div class="input-prepend">
                      <textarea  class="form-control"  name="maps" id="maps" rows="5" >
                          {{(isset($cosmetolog->maps)) ? $cosmetolog->maps : old('maps')}}
                      </textarea>
                    </br></br>
                </div>
            </li>




        </ul>
    </div>
    <div class="col-md-6">
        <ul style=" list-style-type: none">

            @if($img)
                <li class="textarea-field">
                    <label for="message-contact-us">
                        </br>    <span class="label">Главное фото:</span>
                    </label>
                    </br>
                    <img style="max-width: 360px" src={{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/main/main.jpg") }}  />
                    <input  class="hidden" type="hidden" name="old_image" id="old_image" value="{{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/main/main.jpg") }}"  >
                    </br>
                    <input class="form-check-input" type="checkbox" value="deleteCheck" id="deleteCheck" name="deleteCheck">
                    <label class="form-check-label" for="deleteCheck">Удалить фото</label>
                    </br></br>
                </li>
            @endif

            <li class="textarea-field">
                <label for="name-contact-us">
                    </br><span class="label">Фото:</span>
                </label>
                <div class="input-prepend">
                    <input type="file" class="filestyle data-buttonText" name="imageMain" id="imageMain" value="Выберите файл">
                </div>
            </li>


            @if($imgLogo)
                <li class="textarea-field">
                    <label for="message-contact-us">
                        </br>    <span class="label">Логотип:</span>
                    </label>
                    </br>
                    <img style="max-width: 360px" src={{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/logo/logo.png") }}  />
                    <input  class="hidden" type="hidden" name="old_image_logo" id="old_image_logo" value="{{ asset("storage/assets/img/cosmetologies/".$cosmetolog->id."/logo/logo.jpg") }}"  >
                    </br>
                    <input class="form-check-input" type="checkbox" value="deleteLogoCheck" id="deleteLogoCheck" name="deleteLogoCheck">
                    <label class="form-check-label" for="deleteLogoCheck">Удалить логотип</label>
                    </br></br>
                </li>
            @endif


            <li class="textarea-field">
                <label for="name-contact-us">
                    </br><span class="label">Логотип:</span>
                </label>
                <div class="input-prepend">
                    <input type="file" class="filestyle data-buttonText" name="imageLogo" id="imageLogo" value="Выберите файл">
                </div>
            </li>




                <li class="text-field">
                    <label for="site">
                        </br>  <span class="label">Сайт:</span>
                    </label>
                    <div class="input-prepend">
                        <input class="form-control" type="text" name="site" id="site" value="{{(isset($cosmetolog->site)) ?$cosmetolog->site : old('site')}}" placeholder="Введите адрес сайта" >
                        </br>
                    </div>
                </li>


                <li class="text-field">
                    <label for="e_mail">
                        </br>  <span class="label">Эл. почта:</span>
                    </label>
                    <div class="input-prepend">
                        <input class="form-control" type="text" name="e_mail" id="e_mail" value="{{(isset($cosmetolog->e_mail)) ?$cosmetolog->e_mail : old('e_mail')}}" placeholder="Введите эл. почту" >
                        </br>
                    </div>
                </li>


                <li class="text-field">
                    <label for="vk">
                        </br>  <span class="label">Вконтакте:</span>
                    </label>
                    <div class="input-prepend">
                        <input class="form-control" type="text" name="vk" id="vk" value="{{(isset($cosmetolog->vk)) ?$cosmetolog->vk : old('vk')}}"  >
                        </br>
                    </div>
                </li>


                <li class="text-field">
                    <label for="ok">
                        </br>  <span class="label">Одноклассники:</span>
                    </label>
                    <div class="input-prepend">
                        <input class="form-control" type="text" name="ok" id="ok" value="{{(isset($cosmetolog->ok)) ?$cosmetolog->ok : old('ok')}}" >
                        </br>
                    </div>
                </li>


                <li class="text-field">
                    <label for="fb">
                        </br>  <span class="label">Фейсбук:</span>
                    </label>
                    <div class="input-prepend">
                        <input class="form-control" type="text" name="fb" id="fb" value="{{(isset($cosmetolog->fb)) ?$cosmetolog->fb : old('fb')}}"  >
                        </br>
                    </div>
                </li>


                <li class="text-field">
                    <label for="inst">
                        </br>  <span class="label">Инстаграмм:</span>
                    </label>
                    <div class="input-prepend">
                        <input class="form-control" type="text" name="inst" id="inst" value="{{(isset($cosmetolog->inst)) ?$cosmetolog->inst : old('inst')}}" >
                        </br>
                    </div>
                </li>


        </ul>
    </div>
</div>
