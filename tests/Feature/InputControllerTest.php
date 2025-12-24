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

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'thisgleam',
            'married' => true,
            'birth_date' => '2000-01-01'
        ])
            ->assertSeeText("thisgleam")
            ->assertSeeText("true")
            ->assertSeeText("2000-01-01");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only',[
            "name" => [
                "first" => "thisgleam",
                "last" => "gleam"
            ],
        ])->assertSeeText("thisgleam")->assertSeeText("gleam");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except',[
            "username" => "thisgleam",
            "password" => "bener",
            "admin" => "true"
        ])->assertSeeText("thisgleam")->assertSeeText("bener")
        ->assertDontSeeText("true");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "thisgleam",
            "password" => "bener",
            "admin" => "true"
        ])
            ->assertSeeText("thisgleam")
            ->assertSeeText("bener")
            ->assertSeeText("false");
    }
}
