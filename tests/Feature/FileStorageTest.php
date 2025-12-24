<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStorage()
    {
        $filesystem = Storage::disk("local");

        $filesystem->put("hello.txt", "Hello World");

        $content = $filesystem->get("hello.txt");

        self::assertEquals("Hello World", $content);
    }

    public function testPublic()
    {
        $filesystem = Storage::disk("public");

        $filesystem->put("hello.txt", "Hello World");

        $content = $filesystem->get("hello.txt");

        self::assertEquals("Hello World", $content);
    }
}
