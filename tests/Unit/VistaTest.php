<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class VistaTest extends TestCase
{
    public function testVista1()
    {
        $this->get("/")
            ->assertStatus(200)
            ->assertSee("BANCO UNION COLOMBIANO")
            ->assertSuccessful();
    }

    public function testVista3()
    {
        $this->get("/3")
            ->assertStatus(200)
            ->assertSee("Información")
            ->assertSuccessful();
    }
}
