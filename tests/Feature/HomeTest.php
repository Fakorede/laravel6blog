<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase {
    public function testHomePageIsWorkingCorrectly() {
        $response = $this->get('/');

        $response->assertSeeText('Welcome to Laravel');
        $response->assertStatus(200);
    }

    public function testContactPageIsWorkingCorrectly() {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact');
        $response->assertStatus(200);
    }
}
