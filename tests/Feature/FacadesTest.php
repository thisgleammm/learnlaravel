<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class FacadesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);
    }

    public function testFacadesMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Budi');

        $firstName = Config::get('contoh.author.first');
        self::assertEquals('Budi', $firstName);
    }
}
