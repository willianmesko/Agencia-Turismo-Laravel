<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reserve;
use App\User;
use App\Models\Flight;
use App\Http\Requests\StoreReserveFormRequest;

class ReserveController extends Controller
{
    private $reserve;
    private $totalPage = 50;

    public function __construct(Reserve $reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Reservas de Passagens aéreas';

        $reserves = $this->reserve->with(['user', 'flight'])->paginate($this->totalPage);

        return view('panel.reserves.index', compact('title', 'reserves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nova Reserva';

        $users = User::pluck('name', 'id');
        $flights = Flight::pluck('id', 'id');

        $status = $this->reserve->status();

        return view('panel.reserves.create', compact('title', 'users', 'flights', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReserveFormRequest $request)
    {
        if ( $this->reserve->create($request->all()) )
            return redirect()
                        ->route('reserves.index')
                        ->with('message', 'Reservado com sucesso!');

        return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Falha ao reservar!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reserve = $this->reserve->with(['user', 'flight'])->find($id);
        if (!$reserve)
            return redirect()->back();

        $user = $reserve->user;
        $flight = $reserve->flight;
        $status = $this->reserve->status();

        $title = "Editar reserva do usuário {$user->name}";

        return view('panel.reserves.edit', compact('reserve', 'user', 'flight', 'title', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reserve = $this->reserve->find($id);
        if (!$reserve)
            return redirect()->back();

        if ($reserve->changeStatus($request->status))
            return redirect()
                    ->route('reserves.index')
                    ->with('message', 'Status Atualizado com sucesso!');

        return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Falha ao atualizar o status!');
    }


    public function search(Request $request)
    {
        $reserves = $this->reserve->search($request, $this->totalPage);

        $title = "Resultados para a pesquisa";

        $dataForm = $request->except('_token');

        return view('panel.reserves.search', compact('reserves', 'title', 'dataForm'));
    }
}
