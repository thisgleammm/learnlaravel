<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'gleam')
            ->assertSessionHas('isMember', true);
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'gleam',
            'isMember' => "true",
        ])->get('/session/get')
            ->assertSeeText('User ID: gleam, Is Member: true');
    }

    public function testGetSessionFailed()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText('User ID: guest, Is Member: false');
    }
}
