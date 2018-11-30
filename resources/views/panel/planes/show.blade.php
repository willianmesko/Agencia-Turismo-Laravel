@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home > </a>
    <a href="{{route('planes.index')}}" class="bred">Planes > </a>
    <a href="" class="bred">{{$plane->id}}</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$plane->name}}</h1>
</div>

<div class="content-din">
    <ul>
        <li>
            Código: <strong>{{$plane->id}}</strong>
        </li>
        <li>
            Marca: <strong>{{$brand}}</strong>
        </li>
        <li>
            Quantidade de Passageiros: <strong>{{$plane->qty_passengers}}</strong>
        </li>
    </ul>

@include('panel.includes.alerts')

{!! Form::open(['route' => ['planes.destroy', $plane->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
    <div class="form-group">
        <button class="btn btn-danger">Deletar o avião {{$plane->name}}</button>
    </div>
{!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection