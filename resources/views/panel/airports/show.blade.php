@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home > </a>
    <a href="{{route('airports.index', $city->id)}}" class="bred"> Cidade {{$city->name}} > </a>
    <a href="" class="bred">Detalhes do Aeroporto</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$airport->name}} - {{ $city->name }}</h1>
</div>

<div class="content-din">
    <ul>
        <li>
            Nome: <strong>{{$airport->name}}</strong>
        </li>
        <li>
            Latitude: <strong>{{$airport->latitude}}</strong>
        </li>
        <li>
            Longitude: <strong>{{$airport->longitude}}</strong>
        </li>
        <li>
            Endereço: <strong>{{$airport->address}}</strong>
        </li>
        <li>
            Número: <strong>{{$airport->number}}</strong>
        </li>
        <li>
            Código Postal: <strong>{{$airport->zip_code}}</strong>
        </li>
        <li>
            Complemento: <strong>{{$airport->complement}}</strong>
        </li>
    </ul>

@include('panel.includes.alerts')

{!! Form::open(['route' => ['airports.destroy', $city->id, $airport->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
    <div class="form-group">
        <button class="btn btn-danger">Deletar o aeroporto: {{$airport->name}}</button>
    </div>
{!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection