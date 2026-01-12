@extends('components.layout')
@section('content')
    <p>Halo {{ Auth::user()->name }} !</p>
@endsection