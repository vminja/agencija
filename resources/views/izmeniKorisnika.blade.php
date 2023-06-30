@extends('layouts.app')
   

@section('content')
    <admin-korisnik-izmeni :data="{{ $data }}"></admin-korisnik-izmeni>
@endsection

@section('footer')
    <futer/>
@endsection