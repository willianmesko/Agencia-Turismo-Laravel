@extends('site.layouts.app')

@section('content-site')

<div class="content">

    <section class="container">
        <h1 class="title">Promoções</h1>


        <div class="row">
            @forelse($promotions as $flight)
            <article class="result col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="image-promo">
                    <img src="{{url("storage/flights/{$flight->image}")}}" alt="{{ $flight->id }}">

                    <div class="legend">
                        <h1>{{ $flight->destination->city->name }}</h1>
                        <h2>Saída: {{ $flight->origin->city->name }}</h2>
                        <span>Ida</span>
                    </div>
                </div><!--image-promo-->

                <div class="details">
                    <p>Data: {{formatDateAndTime($flight->date)}}</p>

                    <div class="price">
                        <span>R$ {{number_format($flight->price, 2, ',', '.')}}</span>
                        <strong>Em até {{ $flight->total_plots }}x</strong>
                    </div>

                    <a href="{{route('details.flight', $flight->id)}}" class="btn btn-buy">Visualizar</a>
                </div><!--details-->

            </article><!--result-->
            @empty
                <p>Nenhuma Promoção Cadastrada!</p>
            @endforelse
        </div><!--Row-->
    </section><!--Container-->

</div>

@endsection