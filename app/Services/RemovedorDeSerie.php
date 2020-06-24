<?php


namespace App\Services;

//Faz os imports das 3 classes em apenas uma linha
use Illuminate\Support\Facades\DB;
use App\{Serie, Temporada, Episodio};

class RemovedorDeSerie
{
    public function removerSerie(int $idSerie): String
    {
        $nomeSerie = '';


        //Exemplo usando controle de transacao com funcao anonima.
        //Neste caso se algum erro ocorrer o Laravel automaticamente
        //fara o rollback da transacao.
        //O controle de transacao pode ser feito tambem sem
        //funcao anonima
        //@see CriadorDeSerie::criarSerie()
        DB::transaction(function () use (&$nomeSerie, $idSerie) {
            $serie = Serie::find($idSerie);
            $nomeSerie = $serie->nome;

            $this->removerTemporada($serie);

            //Serie::destroy($request->id);
            $serie->delete();
        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     */
    private function removerTemporada($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

}
