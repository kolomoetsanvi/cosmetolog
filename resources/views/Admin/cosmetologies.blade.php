@extends('layouts.layoutAdmin')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    {!! $content !!}
@endsection
