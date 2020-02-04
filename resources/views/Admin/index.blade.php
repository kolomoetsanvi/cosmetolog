@extends('layouts.layoutAdmin')

@section('menu')
    @include('admin.menu')
@endsection


@section('content')
    <link href="{{ asset("assets/site/css/adminIndexStyle.css") }}" rel="stylesheet" />

    <div class="row">
        <div class="col-md-12 text-center">
              <p class="adminIndexText">Косметология</p>
              <p class="adminIndexText2">in your city </p>
        </div>
    </div>
@endsection


