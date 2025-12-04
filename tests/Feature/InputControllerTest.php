<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInput()
    {
        $this->get('/input/hello?name=thisgleam')
            ->assertSeeText('Hello, thisgleam');

        $this->post('/input/hello', [
            'name' => 'thisgleam'
        ])
            ->assertSeeText('Hello, thisgleam');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'thisgleam',
                'last' => 'gleam'
            ]
        ])
            ->assertSeeText('Hello, thisgleam');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'thisgleam',
                'last' => 'gleam'
            ]
        ])
            ->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("gleam");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Macbook Pro',
                    'price' => 16000000
                ],
                [
                    'name' => 'Samsung Galaxy S23',
                    'price' => 12000000
                ]
            ]
        ])->assertSeeText("Apple Macbook Pro")
            ->assertSeeText("Samsung Galaxy S23");
    }
}
