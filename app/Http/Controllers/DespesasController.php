<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TestService;

class DespesasController extends Controller
{
    protected $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function index()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        return view('templatemo-js.despesas');
    }
}
