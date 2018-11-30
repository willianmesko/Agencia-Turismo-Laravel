@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home > </a>
    <a href="{{route('users.index')}}" class="bred">Usuários > </a>
    <a href="" class="bred">{{$user->name}}</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Detalhes do Usuário: {{$user->name}}</h1>
</div>

<div class="content-din">
    <ul>
        <li>
            @if($user->image)
                <img src="{{url("storage/users/{$user->image}")}}" alt="{{$user->id}}" style="max-width: 60px;">
            @else
                <img src="{{url('assets/panel/imgs/no-image.png')}}" alt="{{$user->id}}" style="max-width: 100px;">
            @endif
        </li>
        <li>
            Nome: <strong>{{$user->name}}</strong>
        </li>
        <li>
            E-mail: <strong>{{$user->email}}</strong>
        </li>     
    </ul>

@include('panel.includes.alerts')

{!! Form::open(['route' => ['users.destroy', $user->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
    <div class="form-group">
        <button class="btn btn-danger">Deletar o Usuário {{$user->name}}</button>
    </div>
{!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection