<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello thisgleam");

        $this->get('/hello-again')
            ->assertStatus(200)
            ->assertSeeText("Hello thisgleam");

        $this->get('/hello-world')
            ->assertStatus(200)
            ->assertSeeText("Hello thisgleam");

        $this->view('hello', ['name' => 'thisgleam'])
            ->assertSeeText("Hello thisgleam");

        $this->view('hello.world', ['name' => 'thisgleam'])
            ->assertSeeText("Hello thisgleam");
    }
}
