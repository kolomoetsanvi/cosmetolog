{{--используется для создания и редактирования услуги--}}
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


            <form method="post" class="form" enctype="multipart/form-data" action="{{ (isset($service->id)) ?  route('admin.services.update', ['id'=>$service->id]) :  route('admin.services.store') }}" >
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-8 offset-2">
                        <ul style=" list-style-type: none">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    </br>  <span class="label">* Услуга:</span>
                                </label>
                                <div class="input-prepend">
                                    <textarea  class="form-control"  name="title" id="title" rows="5" >
                                        {{(isset($service->title)) ? $service->title : old('title')}}
                                   </textarea>
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



