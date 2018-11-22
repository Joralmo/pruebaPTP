<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class PrimeraVistaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVista()
    {
        $this->get("/")
            ->assertStatus(200)
            ->assertSee("BANCO UNION COLOMBIANO")
            ->assertSuccessful()
            ->click('Continuar');
    }
}
