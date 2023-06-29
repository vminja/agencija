@extends('layouts.app')

@section('header')
    <zaglavlje/>
@endsection 

@section('content')
    <admin-blog-prikazi :data="{{ $data }}"/>
@endsection
