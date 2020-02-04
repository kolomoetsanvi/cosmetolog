
@if($articles)
    <div id="content-page" class="content group">
        <div class="container">

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

                    <div class="hentry group">
                        <h2>Работа со статьями</h2>
                        <div class="short-table white">
                            <table class="table-bordered table-striped" style="width: 100% " callspacing="0" cellpadding="10">
                               <thead>
                                    <tr>
                                        <th class="align-left">ID</th>
                                        <th>Заголовок</th>
                                        <th>Текст</th>
                                        <th>Изображение</th>
                                        <th>Действие</th>
                                    </tr>
                               </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td class="align-left">{{$article->id}}</td>
                                            <td class="align-left "> <a href="{{route('admin.articles.edit', ['id'=>$article->id])}}">{{$article->title}} </a></td>
{{--                                            <td class="align-left"> <a href="{{route('admin.articles.edit', ['articles'=>$article->id])}}">{{$article->title}} </a></td>--}}
                                            <td class="align-left">{{str_limit($article->content,200)}}</td>
                                            <td class="align-left">
                                                <img style="max-height: 55px; max-width: 55px" src={{ asset("storage/assets/img/article/".$article->id."/main.jpg") }}  />
                                            </td>
                                            <td style="min-width: 100px">
                                                <form method="post" class="form-horizontal" action="{{route('admin.articles.delete', ['id'=>$article->id])}}" >
{{--                                                <form method="post" class="form-horizontal" action="{{route('admin.articles.destroy', ['articles'=>$article->id])}}" >--}}
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <input class="btn btn-danger " type="submit" value="Удалить" style="margin-left: 10px"/>
                                                    </div>
                                                </form>



{{--                                                {!! Form::open(['url' => route ('admin.articles.destroy', ['articles'=>$article->id]), 'class' => 'form-horizontal', 'method'=>'POST']) !!}--}}
{{--                                                    {{ method_field('DELETE') }}--}}
{{--                                                    {!! Form::button('Удалить', ['class' => 'btn btn-french-5', 'type' => 'submit']) !!}--}}
{{--                                                {!! Form::close() !!}--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{$articles ->links('layouts.paginate')}}
                        <a href="{{route('admin.articles.create')}}" class="btn btn-success btn-lg " role="button" aria-disabled="true">Добавить статью</a>
                    </div>
        </div>
    </div>
@endif
