<?php

use Database\Seeders\JewellerySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $this->seed(JewellerySeeder::class);
    $response = $this->get('/');

    $response->assertStatus(200);
});
