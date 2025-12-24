<?php

namespace Tests\Feature;

use Crypt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEncryption()
    {
        $encrypt = Crypt::encrypt("thisgleam");

        var_dump($encrypt);

        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals("thisgleam", $decrypt);
    }
}
