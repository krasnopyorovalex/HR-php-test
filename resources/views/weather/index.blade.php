@extends('layouts.app')

@section('title', 'Текущая температура в Брянске')

@section('content')
    <h3>Текущая температура в Брянске: {{ format_temperature($temperature) }}</h3>
@endsection
