<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Plane;
use App\Models\Airport;
use App\Http\Requests\StoreUpdateFlightFormRequest;

class FlightController extends Controller
{
    private $flight;
    private $totalPage = 20;

    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Voos disponíveis';

        $flights = $this->flight->getItems();

        $airports = Airport::pluck('name', 'id');
        $airports->prepend('Escolha o aeroporto', '');

        return view('panel.flights.index', compact('title', 'flights', 'airports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar voos';

        $planes = Plane::pluck('id', 'id');
        $airports = Airport::pluck('name', 'id');

        return view('panel.flights.create', compact('title', 'planes', 'airports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateFlightFormRequest $request)
    {
        $nameFile = '';

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $nameFile = uniqid(date('HisYmd')).'.'.$request->image->extension();

            if (!$request->image->storeAs('flights', $nameFile))
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

        }

        if ( $this->flight->newFlight($request, $nameFile) )
            return redirect()
                            ->route('flights.index')
                            ->with('success', 'Sucesso ao cadastrar');
            else
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao cadastrar')
                            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flight = $this->flight->with(['origin', 'destination'])->find($id);
        if(!$flight)
            return redirect()->back();

        $title = "Detalhes do voo {$flight->id}";

        return view('panel.flights.show', compact('flight', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flight = $this->flight->find($id);
        if(!$flight)
            return redirect()->back();
        
        $title = "Editar Voo {$flight->id}";

        $planes = Plane::pluck('id', 'id');
        $airports = Airport::pluck('name', 'id');

        return view('panel.flights.edit', compact('title', 'flight', 'planes', 'airports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFlightFormRequest $request, $id)
    {
        $flight = $this->flight->find($id);
        if(!$flight)
            return redirect()->back();

        $nameFile = $flight->image;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            if($flight->image)
                $nameFile = $flight->image;
            else
                $nameFile = uniqid(date('HisYmd')).'.'.$request->image->extension();

            if (!$request->image->storeAs('flights', $nameFile))
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

        }
        

        if ( $flight->updateFlight($request, $nameFile) )
            return redirect()
                            ->route('flights.index')
                            ->with('success', 'Sucesso ao atualizar');
            else
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao atualizar')
                            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->flight->find($id)->delete();

        return redirect()
                    ->route('flights.index')
                    ->with('success', 'Sucesso ao deletar');
    }


    public function search(Request $request)
    {
        $flights = $this->flight->search($request, $this->totalPage);

        $dataForm = $request->except('_token');

        $title = 'Resultados dos voos pesquisado';

        $airports = Airport::pluck('name', 'id');

        return view('panel.flights.index', compact('title', 'flights', 'dataForm', 'airports'));
    }
}
