@extends('layouts.app')

@section('header')
    <zaglavlje/>
@endsection 

@section('content')
    <blog :data="{{ $data }}"/>
@endsection