<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('templatemo-js.login');
    }

    public function login(Request $request)
    {
        $response = $this->authService->login($request);
        
        if(empty($response)){
            session()->put('message', 'Usuário/senha incorreto');
            session()->put('logged', 0);
            return redirect('/login');
        } else{
            session()->put('message', null);
            session()->put('logged', 1);
            return redirect('/painel');
        }
    }

    public function logout()
    {
        session()->put('message', null);
        session()->put('logged', 0);
        return redirect('/login');
    }
}
