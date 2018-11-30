<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\BrandStoreUpdateFormRequest;

class BrandController extends Controller
{
    private $brand;
    protected $totalPage = 20;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Marcas de Aviões';

        $brands = $this->brand->paginate($this->totalPage);

        return view('panel.brands.index', compact('title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Avião';
        
        return view('panel.brands.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();

        if ($this->brand->create($dataForm))
            return redirect()
                        ->route('brands.index')
                        ->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao cadastrar!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();

        $title = "Detalhes da Marca: {$brand->name}";
            
        return view('panel.brands.show', compact('title', 'brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();

        $title = "Editar Marca: {$brand->name}";

        return view('panel.brands.create-edit', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandStoreUpdateFormRequest $request, $id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();
        
        $update = $brand->update($request->all());

        if ($update)
            return redirect()
                        ->route('brands.index')
                        ->with('success', 'Atualizado com sucesso!');
        else
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao atualizar!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();

        if($brand->delete())
            return redirect()
                ->route('brands.index')
                ->with('success', 'Deletado com sucesso!');
        else
            return redirect()
                ->back()
                ->with('error', 'Falha ao deletar!');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $brands = $this->brand->search($request->key_search, $this->totalPage);

        $title = "Brands, filtros para: {$request->key_search}";

        return view('panel.brands.index', compact('title', 'brands', 'dataForm'));
    }


    public function planes($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();
        
        $planes = $brand->planes()->get();

        $title = "Aviões da marca: {$brand->name}";

        return view('panel.brands.planes', compact('title', 'planes', 'brand'));
    }
}
