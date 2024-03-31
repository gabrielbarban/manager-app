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
            session()->put('id_usuario', $response->id);
            session()->put('nome_usuario', $response->nome);
            session()->put('email_usuario', $response->email);
            return redirect('/painel');
        }
    }

    public function logout()
    {
        session()->put('message', null);
        session()->put('logged', 0);
        session()->put('id_usuario', null);
        session()->put('nome_usuario', null);
        session()->put('email_usuario', null);
        return redirect('/login');
    }
}
