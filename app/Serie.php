<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Serie extends Model
{
    //O nome abaixo nao e necessario neste caso pois o Eloquent
    //usa por padrao o nome da classe no plural para identificar
    //o nome da tabela
    //protected $table = 'series';

    protected $fillable = ['nome'];

    //Informa ao Eloquent que Serie tem uma relacao
    //1 to N com Temporadas
    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }

}
