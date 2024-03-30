<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TestService;

class TestController extends Controller
{
    protected $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function testDatabaseConnection()
    {
        $message = $this->testService->testDatabaseConnection();

        if ($message === "Conexão com o banco de dados estabelecida com sucesso!") {
            return view('database-connection')->with('message', $message);
        } else {
            return redirect()->back()->withErrors([$message]);
        }
    }
}
