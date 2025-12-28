<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMiddlewareInvalid()
    {
        $this->get('/middleware/api')
        ->assertStatus(401)
        ->assertSeeText('Unauthorized');
    }

    public function testMiddlewareValid()
    {
        $this->withHeader('X-API-Key', '123456')
        ->get('/middleware/api')
        ->assertStatus(200)
        ->assertSeeText('API');
    }

    public function testMiddlewareGroupInvalid()
    {
        $this->get('/middleware/group')
        ->assertStatus(401)
        ->assertSeeText('Unauthorized');
    }

    public function testMiddlewareGroupValid()
    {
        $this->withHeader('X-API-Key', '123456')
        ->get('/middleware/group')
        ->assertStatus(200)
        ->assertSeeText('GROUP');
    }
}
