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

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText("Product ID: 1");
    }

    public function testRouteParameterWithMultiple()
    {
        $this->get('/products/1/items/2')
            ->assertSeeText("Product: 1 Item: 2");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText("Category: 1");

        $this->get('/categories/abc')
            ->assertSeeText("404 by thisgleam");
    }

    public function testRouteParameterOpsional()
    {
        $this->get('/users/1')
            ->assertSeeText("User: 1");

        $this->get('/users/')
            ->assertSeeText("User: 404");
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/bahlil')
            ->assertSeeText("Conflict: bahlil");

        $this->get('/conflict/gleam')
            ->assertSeeText("Conflict: gleam");
    }

    public function testNamedRoute()
    {
        $this->get('/product/1')
            ->assertSeeText("Link: http://localhost/products/1");
    }

    public function testNamedRouteRedirect()
    {
        $this->get('/product-redirect/1')
            ->assertRedirect('/products/1');
    }
}
