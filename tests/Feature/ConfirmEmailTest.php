<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfirmEmailTest extends TestCase
{

    use RefreshDatabase;

    /**
     * confirm user when link in email is clicked and redirect to home with success message
     *
     * @return void
     */
    public function test_user_is_confirmed_when_link_in_email_is_clicked()
    {
        $this->withoutExceptionHandling();

        // register a user
        $this->post('/register',[
            'name' => 'saad saif',
            'email' => 'saad@gmail.com',
            'password' => 'something',
            'password_confirmation' => 'something'
        ]);

        $user = User::find(1);

        // get request to confirm user
        $this->get("/register/confirm?token={$user->confirm_token}")
                ->assertRedirect('/')
                ->assertSessionHas('success','Your email has been Confirmed');

        // user has no token
        $this->assertTrue($user->fresh()->isConfirmed());

    }

    /**
     * redirect user with error to heme page if token is wrong
     * 
     */
    public function test_redirect_the_user_with_error_if_token_is_worng()
    {
        $this->withoutExceptionHandling();

        // register a user
        $this->post('/register',[
            'name' => 'saad saif',
            'email' => 'saad@gmail.com',
            'password' => 'something',
            'password_confirmation' => 'something'
        ]);

        // get request to confirm user
        $this->get("/register/confirm?token=WRONG_TOKEN")
                ->assertRedirect('/')
                ->assertSessionHas('error','Confirmation token not recognized');
    }
}
