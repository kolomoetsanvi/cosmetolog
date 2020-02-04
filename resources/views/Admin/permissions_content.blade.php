<div id="content-page" class="content group">
    <div class="container">
            <div class="hentry group">

                <h3 class="title_page">Права пользователей</h3>


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


                <form action="{{route('admin.permissions.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="Short-table white">

                    <table class="table-bordered table-striped " style="width: 100% " callspacing="0" cellpadding="10">
                        <thead>
                            <th>Права</th>
                            @if(!$roles->isEmpty())

                                @foreach($roles as $item)
                                    <th>{{ $item->name}}</th>
                                @endforeach

                            @endif
                        </thead>

                        <tbody>
                        @if(!$permissions->isEmpty())
                            @foreach($permissions as $perm)
                                <tr>
                                    <td>{{ $perm->name}} </td>
                                    @foreach($roles as $rol)
                                        <td>
                                            @if($rol->hasPermission($perm->name))
                                                <input checked name="{{$rol->id}}[]" type="checkbox" value="{{$perm->id}}">
                                            @else
                                                <input name="{{$rol->id}}[]" type="checkbox" value="{{$perm->id}}">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif

                        </tbody>


                    </table>

                    </div>
                </br>
                <input class="btn btn-success btn-lg " type="submit" value="Обновить" />
            </form>
        </div>
    </div>
</div>
