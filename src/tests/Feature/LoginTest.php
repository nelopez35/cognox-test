<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Database\Factories\UserFactory;
use App\Models\User;

class LoginTest extends TestCase
{

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user =  User::factory()->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }
}
