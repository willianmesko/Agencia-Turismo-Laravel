<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Brand;
use App\Models\Plane;
use App\Models\State;
use App\Models\City;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Reserve;

class PanelController extends Controller
{
    public function index()
    {
        $totalBrands    = Brand::count();
        $totalPlanes    = Plane::count();
        $totalStates    = State::count();
        $totalCities    = City::count();
        $totalAirports  = Airport::count();
        $totalFlights   = Flight::count();
        $totalUsers     = User::count();
        $totalReserves  = Reserve::count();

        return view('panel.home.index', compact(
            'totalBrands',
            'totalPlanes',
            'totalStates',
            'totalCities',
            'totalAirports',
            'totalFlights',
            'totalUsers',
            'totalReserves'
        ));
    }
}
