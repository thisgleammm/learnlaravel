<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpload()
    {
        $picture = UploadedFile::fake()->image("gleam.png");

        $this->post('/file/upload', [
            "picture" => $picture
        ])->assertSeeText("OK : gleam.png");
    }
}
