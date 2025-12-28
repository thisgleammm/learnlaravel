<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testURLCurrent()
    {
        $this->get('/url/current?name=gleam')
            ->assertSeeText('/url/current?name=gleam');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/hello/gleam');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
