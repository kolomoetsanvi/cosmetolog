{{--используется для создания и редактирования статей--}}
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


                <form method="post" class="form" enctype="multipart/form-data" action="{{ (isset($article->id)) ?  route('admin.articles.update', ['id'=>$article->id]) :  route('admin.articles.store') }}" >
                    {{ csrf_field() }}


                    <ul style=" list-style-type: none;">
                        <li class="text-field">
                            <label for="name-contact-us">
                                </br>  <span class="label">* Заголовок статьи:</span>
                            </label>
                            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i> </span>
                                <input class="form-control" type="text" name="title" id="title" value="{{(isset($article->title)) ? $article->title : old('title')}}" placeholder="Введите название статьи" >
                                </br></br>
                            </div>
                        </li>

                        <li class="textarea-field">
                            <label for="message-contact-us">
                                </br> <span class="label">* Текст статьи:</span>

                            </label>
                            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i> </span>
{{--                                <input  class="form-control" type="textarea" name="content" id="editor" value="{{(isset($article->content)) ? $article->content : old('content')}}" rows="10" >--}}
                                <textarea  class="form-control"  name="content" id="editor" rows="10" >{{(isset($article->content)) ? $article->content : old('content')}}</textarea>
                                </br></br>
                            </div>
                        </li>


                        <li class="text-field">
                            <label for="name-contact-us">
                                </br>  <span class="label">Косметолог:</span>
                            </label>
                            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i> </span>
                                <select class="form-control" id="selectCosmetolog" name="selectCosmetolog" size="1" >
                                          <option value="-1">------</option>
                                    @foreach($cosmetologies as $cosmetolog)
                                        @if(isset($article->cosmetologies_id) && $cosmetolog->id == $article->cosmetologies_id )
                                            <option selected="selected" value="{{$cosmetolog->id}}">{{$cosmetolog->title}}</option>
                                        @else
                                          <option value="{{$cosmetolog->id}}">{{$cosmetolog->title}}</option>
                                        @endif
                                      @endforeach
                                </select>
                                </br> </br>
                            </div>
                        </li>



                        @if($img)
                           <li class="textarea-field">
                                <label for="message-contact-us">
                                    </br>    <span class="label">Текущее изображение:</span>
                                    </br>
                                </label>
                                <img style="max-height: 200px" src={{ asset("storage/assets/img/article/".$article->id."/main.jpg") }}  />
                                <input  class="hidden" type="hidden" name="old_image" id="old_image" value="{{ asset("storage/assets/img/article/".$article->id."/main.jpg") }}"  >
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
                </form>



{{--            <script>--}}

{{--                ClassicEditor--}}
{{--                    .create( document.querySelector( '#editor' ) )--}}
{{--                    .catch( error => {--}}
{{--                        console.error( error );--}}
{{--                    } );--}}
{{--            </script>--}}


            </div>
        </div>
    </div>


