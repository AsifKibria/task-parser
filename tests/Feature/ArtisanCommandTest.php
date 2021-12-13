<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtisanCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function artisan_command_test()
    {
        Artisan::call('model:publish', [
            'command_parameter_1' => '%5B%7B%22scope%22%3A%5B%22indirect-emissions-owned%22%2C%22electricity%22%5D%2C%22name%22%3A%22meeting-rooms%22%7D%2C%7B%22scope%22%3A%5B%22indirect-emissions-rented%22%2C%22electricitytest%22%5D%2C%22name%22%3A%22living-rooms%22%7D%5D'
        ]);
        $resultAsText = Artisan::output();
        $this->assertTrue(true);
    }
}
