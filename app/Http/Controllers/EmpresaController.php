<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmpresaService;

class EmpresaController extends Controller
{
    protected $empresaService;

    public function __construct(EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
    }

    public function index()
    {
        $empresas = $this->empresaService->listEmpresas();
        return view('templatemo-js.empresas')->with('empresas', $empresas);
    }

    public function novo()
    {
        return view('templatemo-js.novo-empresa');
    }

    public function save(Request $request)
    {
        if((isset($request->id) && !empty($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/usuario'.'/'.$request->id)->with('error', 'As senhas informadas não são iguais.');
        } elseif((!isset($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/usuario/novo')->with('error', 'As senhas informadas não são iguais.');
        }

        $empresa = $this->empresaService->save($request);

        if((isset($request->id) && !empty($request->id))){
             return redirect('/empresas')->with('success', 'Empresa atualizada com sucesso!')
                ->with('categoria', $empresa);
        } else{
            return redirect('/empresas')->with('success', 'Empresa salva com sucesso!')
                ->with('categoria', $empresa);
        }
    }

    public function get($id)
    {
        $empresa = $this->empresaService->get($id);
        return view('templatemo-js.edit-empresa')->with('empresa', $empresa);
    }
}
