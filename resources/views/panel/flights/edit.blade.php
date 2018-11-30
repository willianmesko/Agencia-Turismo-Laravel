@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home > </a>
    <a href="{{route('flights.index')}}" class="bred">Voos > </a>
    <a href="" class="bred">Editar</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Editar Voo {{$flight->id}}</h1>
</div>

<div class="content-din">

@include('panel.includes.errors')

{!! Form::model($flight, ['route' => ['flights.update', $flight->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
    @include('panel.flights.form')
{!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection