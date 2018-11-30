<div class="form-search">
    {!! Form::open(['route' => 'reserves.search', 'class' => 'form form-inline']) !!}
        {!! Form::text('user', null, ['class' => 'form-control', 'placeholder' => 'Detalhes do Usuário?']) !!}

        {!! Form::text('reserve', null, ['class' => 'form-control', 'placeholder' => 'Detalhes da Reserva?']) !!}

        {!! Form::date('date', null, ['class' => 'form-control', 'placeholder' => 'Data do Voo']) !!}

        {!! Form::select('status', [
                            'reserved'  => 'Reservado',
                            'canceled'  => 'Cancelado',
                            'paid'      => 'Pago',
                            'concluded' => 'Concluído',
                        ], null, ['class' => 'form-control']) !!}

        <button class="btn btn-search">Pesquisar</button>
    {!! Form::close() !!}

    @if(isset($dataForm['key_search']))
        <div class="alert alert-info">
            <p>
                <a href="{{route('planes.index')}}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                Resultados para: <strong>{{$dataForm['key_search']}}</strong>
            </p>
        </div>
    @endif
</div>