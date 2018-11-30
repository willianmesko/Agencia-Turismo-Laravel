<div class="form-group">
    <label for="plane_id">Escolha o avião</label>
    {!! Form::select('plane_id', $planes, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="airport_origin_id">Origem</label>
    {!! Form::select('airport_origin_id', $airports, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="airport_destination_id">Destino</label>
    {!! Form::select('airport_destination_id', $airports, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="date">Data</label>
    {!! Form::date('date', null, ['class' => 'form-control', 'placeholder' => 'Data']) !!}
</div>
<div class="form-group">
    <label for="time_duration">Duração</label>
    {!! Form::time('time_duration', null, ['class' => 'form-control', 'placeholder' => 'Duração']) !!}
</div>
<div class="form-group">
    <label for="hour_output">Horas Saída</label>
    {!! Form::time('hour_output', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="arrival_time">Horas Chegada</label>
    {!! Form::time('arrival_time', null, ['class' => 'form-control', 'placeholder' => 'Horas Chegada']) !!}
</div>
<div class="form-group">
    <label for="old_price">Preço Anterior</label>
    {!! Form::text('old_price', null, ['class' => 'form-control', 'placeholder' => 'Preço Anterior']) !!}
</div>
<div class="form-group">
    <label for="price">Preço</label>
    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Preço']) !!}
</div>
<div class="form-group">
    <label for="price">Total de Parelas</label>
    {!! Form::number('total_plots', null, ['class' => 'form-control', 'placeholder' => 'Total de Parelas']) !!}
</div>
<div class="form-group">
    {!! Form::checkbox('is_promotion', true, null, ['id' => 'is_promotion']) !!}
    <label for="price">É promoção?</label>
</div>
<div class="form-group">
    <label for="image">Foto</label>
    {!! Form::file('image', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="price">Quantidade de paradas</label>
    {!! Form::number('qty_stops', null, ['class' => 'form-control', 'placeholder' => 'Quantidade de paradas']) !!}
</div>
<div class="form-group">
    <label for="price">Descrição</label>
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição do voo']) !!}
</div>

<div class="form-group">
    <button class="btn btn-search">Enviar</button>
</div>