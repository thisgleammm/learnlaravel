<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello World');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'John Doe')
            ->assertHeader('App', 'Learn Laravel');
    }

    public function testResponseView()
    {
        $this->get('/response/view')
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertViewHas('name', 'John Doe');
    }

    public function testResponseJson()
    {
        $this->get('/response/json')
            ->assertStatus(200)
            ->assertJson([
                'firstName' => 'John',
                'lastName' => 'Doe',
            ]);
    }

    public function testResponseFile()
    {
        $this->get('/response/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testResponseDownload()
    {
        $this->get('/response/download')
            ->assertDownload('gleam.png');
    }
}
