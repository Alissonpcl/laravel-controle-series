<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
    }

    public function entrar(Request $request)
    {
        $logged = Auth::attempt($request->only(['email', 'password']));
        if (!$logged){
            return redirect()
                ->back()
                ->withErrors('Usuário e/ou senha incorretos.');
        }
        return redirect()->route('lista_series');
    }
}
