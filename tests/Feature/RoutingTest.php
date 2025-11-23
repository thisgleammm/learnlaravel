<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $this->get('/thisgleam')
            ->assertStatus(200)
            ->assertSeeText("Selamat Datang thisgleam");
    }
    
    public function testRedirect()
    {
        $this->get('/me')
            ->assertRedirect('/thisgleam');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText("404 by thisgleam");
    }
}
