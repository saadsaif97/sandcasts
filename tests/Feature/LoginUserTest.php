<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUser extends TestCase
{
    use RefreshDatabase;

    public function test_user_gets_correct_response_after_successful_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('laravel'),
        ]);

        $this->postJson('/login',[
            "email" => $user->email,
            "password" => 'laravel',
        ])
        ->assertStatus(200)
        ->assertJson([
            "status" => "ok"
        ]);
    }


    public function test_the_user_gets_correct_error_on_wrong_password()
    {
        

        $user = User::factory()->create([
            'password' => bcrypt('laravel'),
        ]);

        $this->postJson('/login',[
            "email" => $user->email,
            "password" => 'wrong-password',
        ])
        ->assertStatus(422)
        ->assertJson([
            "message" => "These credentials do not match our records."
        ]);
    }
}
