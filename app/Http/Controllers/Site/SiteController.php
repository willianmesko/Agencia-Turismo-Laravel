<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Reserve;
use App\Http\Requests\StoreReserveFormRequest;
use App\User;

class SiteController extends Controller
{
    public function index()
    {
        $title = 'Home Page';

        $airports = Airport::with('city')->get();

        return view('site.home.index', compact('title', 'airports'));
    }

    public function promotions(Flight $flight)
    {
        $title = 'Promoções';

        $promotions = $flight->promotions();

        return view('site.promotions.list', compact('title', 'promotions'));
    }


    public function search(Request $request, Flight $flight)
    {
        $title = 'Resultados da Pesquisa';

        $origin = getInfoAirport($request->origin);
        $destionation = getInfoAirport($request->destination);

        $flights = $flight->searchFlights(
                                $origin['id_airport'],
                                $destionation['id_airport'],
                                $request->date
                            );

        return view('site.search.search', [
            'title'         => $title,
            'flights'       => $flights,
            'origin'        => $origin['name_city'],
            'destionation'  => $destionation['name_city'],
            'date'          => formatDateAndTime($request->date)
        ]);
    }


    public function detailsFlight($idFlight)
    {
        if(!$flight = Flight::with(['origin', 'destination'])->find($idFlight))
            return redirect()->back();

        $title = "Detalhes do voo {$flight->id}";

        return view('site.flights.details', compact('flight', 'title'));
    }


    public function reserveFlight(StoreReserveFormRequest $request, Reserve $reserve)
    {
        if ( $reserve->newReserve($request->flight_id) )
            return redirect()
                        ->route('purchases')
                        ->with('success', 'Reserva Realizada com Sucesso!');
        

        return redirect()
                    ->back()
                    ->with('error', 'Falha ao reservar!');
    }


    public function myPurchases()
    {
        $title = 'Minhas Compras';

        $purchases = auth()->user()->reserves()->orderBy('date_reserved')->get();

        return view('site.users.purchases', compact('title', 'purchases'));
    }


    public function purchaseDetail($idReserve)
    {
        $reserve = Reserve::where('user_id', auth()->user()->id)
                                ->where('id', $idReserve)
                                ->get()
                                ->first();
        if (!$reserve)
            return redirect()->back();

        $flight = Flight::with(['origin', 'destination'])->find($reserve->flight_id);
        if (!$flight)
            return redirect()->back();

        $title = "Detalhes do voo {$flight->id}";

        return view('site.users.details-purchase', compact('flight', 'title'));
    }
}
