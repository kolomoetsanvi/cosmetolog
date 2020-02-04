<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">
        @if(!Gate::denies('ADD_COSMETOLOGIES'))
            <li class="nav-item" style="margin-left: 40px">
                <a class="nav-link" href="{{route('admin.personnel.index')}}">Персонал</a>
            </li>
        @endif
        @if(!Gate::denies('ADD_COSMETOLOGIES'))
            <li class="nav-item" >
                <a class="nav-link" href="{{route('admin.services.index')}}">Услуги</a>
            </li>
        @endif
        @if(!Gate::denies('ADD_COSMETOLOGIES'))
            <li class="nav-item" >
                <a class="nav-link" href="{{route('admin.cosmetologies.index')}}">Косметологии</a>
            </li>
        @endif
        @if(!Gate::denies('ADD_COSMETOLOGIES'))
            <li class="nav-item" >
                <a class="nav-link" href="{{route('admin.promotions.index')}}">Акции</a>
            </li>
        @endif
        @if(!Gate::denies('ADD_ARTICLES'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.articles.index')}}">Статьи</a>
            </li>
        @endif
        @if(!Gate::denies('VIEW_REPORT'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.reports.index')}}">Отчеты</a>
            </li>
        @endif
        @if(!Gate::denies('EDIT_USERS'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users.index')}}">Пользователи</a>
            </li>
        @endif
        @if(!Gate::denies('EDIT_USERS'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.permissions.index')}}">Разрешения</a>
            </li>
        @endif
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    Выход
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>


{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ url('/logout') }}">Выход</a>--}}
{{--        </li>--}}
    </ul>
</div>
