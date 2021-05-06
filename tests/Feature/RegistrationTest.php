<?php

namespace Tests\Feature;

use App\Mail\ConfirmYourEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_has_default_username_from_name_slug()
    {
        $this->withoutExceptionHandling();

        $this->post('/register',[
            'name' => 'saad saif',
            'email' => 'saad@gmail.com',
            'password' => 'something',
            'password_confirmation' => 'something'
        ])
        ->assertStatus(302);

        $this->assertDatabaseHas('users',[
            'username'=> Str::slug('saad saif')
        ]);
    }

    public function test_newly_registered_user_gets_an_email_of_confirmation()
    {

        $this->withoutExceptionHandling();

        Mail::fake();
        // register a user
        $user = $this->post('/register',[
            'name' => 'saad saif',
            'email' => 'saad@gmail.com',
            'password' => 'something',
            'password_confirmation' => 'something'
        ]);

        // assert the email is sent
        Mail::assertSent(ConfirmYourEmail::class);
    }

    public function test_newly_registered_user_has_confirm_token()
    {
        // register a user
        $this->post('/register',[
            'name' => 'saad saif',
            'email' => 'saad@gmail.com',
            'password' => 'something',
            'password_confirmation' => 'something'
        ])->assertRedirect();

        $user = User::find(1);

        $this->assertNotNull($user->confirm_token);
        $this->assertFalse($user->isConfirmed());

    }
}
