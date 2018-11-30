@extends('site.layouts.app')

@section('content-site')

<div class="content">

    <section class="container">
        <h1 class="title">Minhas Compras</h1>


        <table class="table">
            <thead>
                <tr>
                    <th width="50">Cod</th>
                    <th>Vôo</th>
                    <th>Data</th>
                    <th width="100">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>
                        <a href="{{ route('purchase.detail', $purchase->id) }}" class="badge badge-light">
                            Ver Detalhes Voô: {{ $purchase->flight_id }}
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>{{ formatDateAndTime($purchase->date) }}</td>
                    <td>
                        <span class="badge badge-secondary">{{ $purchase->status }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="30">
                        Nenhuma Reserva!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section><!--Container-->

</div>

@endsection