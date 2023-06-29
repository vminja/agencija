@extends('layouts.layoutApp')

@section('header')
    <zaglavlje/>
@endsection 

@section('content')
    <blog :data="{{ $data }}"/>
@endsection

@section('footer')
    <futer/>
@endsection 