<?php


namespace App\Http\Controllers;


use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    //Movido para protecao direto em rotas
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(Request $request)
    {
        //$series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');
        return view('series.index', compact('series', 'mensagem'));
        //O mesmo que:
        //return view('series.index', ['series' => $series]);
    }

    public function create(Request $request)
    {
        //mapeia para view/series/create.blade.php
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
             $request->ep_por_temporada);

        $request->session()
            ->flash('mensagem', "Série {$serie->nome} e suas temporadas e episódios criada com sucesso.");

        return redirect()->route('lista_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()
            ->flash('mensagem', "Série $nomeSerie removida com sucesso.");
        return redirect()->route('lista_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
