<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /** @var Temporada */
    private $temporada;

    protected function setUp(): void
    {
        parent::setUp();
        $this->temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->assistido = true;
        $this->temporada->episodios->add($episodio1);

        $episodio2 = new Episodio();
        $episodio2->assistido = false;
        $this->temporada->episodios->add($episodio2);

        $episodio3 = new Episodio();
        $episodio3->assistido = true;
        $this->temporada->episodios->add($episodio3);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBuscaPorEpisodiosAssistidos()
    {
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $episodiosAssistidos);

        foreach ($episodiosAssistidos as $episodio){
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testBuscaTodosOsEpisodios()
    {
        $todosEpisodios = $this->temporada->episodios;
        $this->assertCount(3, $todosEpisodios);
    }
}
