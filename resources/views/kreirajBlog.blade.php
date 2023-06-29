@extends('layouts.layoutApp')

@section('header')
    <zaglavlje/>
@endsection 

@section('content')
    <admin-blog-kreiraj :data="{{ $data }}"></admin-blog-kreiraj>
@endsection


