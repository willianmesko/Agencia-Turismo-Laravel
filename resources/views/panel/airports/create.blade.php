@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home > </a>
    <a href="{{route('airports.index', $city->id)}}" class="bred"> Cidade {{$city->name}} > </a>
    <a href="" class="bred">Cadastrar Aeroporto</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Cadastrar Aeroporto para a cidade {{$city->name}}</h1>
</div>

<div class="content-din">

@include('panel.includes.errors')

{!! Form::open(['route' => ['airports.store', $city->id], 'class' => 'form form-search form-ds']) !!}
    @include('panel.airports.form')
{!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection