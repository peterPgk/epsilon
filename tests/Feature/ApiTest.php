<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /** @test */
    public function an_unauthenticated_user_should_be_reddirected_to_login()
    {
        $response = $this->get('/api/services');

        $response->assertRedirect('/login');
    }
}
