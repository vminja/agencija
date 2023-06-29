@extends('layouts.layoutApp')
   
@section('header')
    <zaglavlje/>
@endsection

@section('content')
    <admin-blog-izmeni :data="{{ $data }}"></admin-blog-izmeni>
@endsection