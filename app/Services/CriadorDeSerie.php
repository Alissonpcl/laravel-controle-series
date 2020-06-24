<?php


namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;
use function foo\func;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada): Serie
    {

        //Exemplo usando controle de transacao sem funcao anonima.
        //Neste caso se algum erro ocorrer o Laravel o rollback
        //da transacao devera ser executado manualmente (neste caso aqui nao
        //e necessario pois se ocorrer erro o commit nao sera realizado).
        //A transacao pode ser controlada tambem por funcao anonima
        //@see RemovedorDeSerie::removerSerie()
        DB::beginTransaction();

        //Mapeia manualmente campo a campo
        $serie = Serie::create(['nome' => $nomeSerie]);

        //OU

        //O create ira mapear automaticamente os campos do
        //request para os campos/atributos da entidade serie
        //$serie = Serie::create($request->all());

        $this->criarTemporadas($qtdTemporadas, $serie, $epPorTemporada);

        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $epPorTemporada
     */
    private function criarTemporadas(int $qtdTemporadas, $serie, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criarEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    private function criarEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $episodio = $temporada->episodios()->create(['numero' => $j]);
        }
    }

}
