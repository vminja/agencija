@extends('layouts.layoutApp')

@section('header')
    <zaglavlje/>
@endsection 

@section('content')
    <admin-blog-prikazi :data="{{ $data }}"/>
@endsection
