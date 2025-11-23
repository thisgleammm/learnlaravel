<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $this->assertEquals('Contoh Aplikasi', config('contoh.app_name'));
        $this->assertEquals('1.0.0', config('contoh.version'));
        $this->assertTrue(config('contoh.debug'));
        $this->assertEquals('localhost', config('contoh.database.host'));
        $this->assertEquals(3306, config('contoh.database.port'));
    }
}
