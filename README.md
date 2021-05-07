<p align="center">Learning from Project</p>

```
config variables in laravel are like the global variables and are cached by laravel,
Using environment variable directly will slowdown our project because project always
go to environment to get that variable, so you have to fetch the environment variable
using the config variables, because it will be stored in the cache by the laravel and
project speed will not slow down
```

```
IoC | DI (inversion of control | dependency injection)

PLUG AND PLAY | not hard and fast code

we create a wrapper around the plug from outside and make a FACADE for ourself and then
we can use any plug from outside and our FACADE | ADAPTER will handle it

By doing so, we are depending on our FACEDE and not the code provieded by external APIs

we provide the dependency to our facade to use

for example, in Store FACADE, we can inject PayPalPaymentProcessor or StripePaymentProcessor,
these payment processors will align outer apis to our FACADE

```

to use the vue component, it should be in the scope of vuw instance as:

```
<div id="app">
   <vue-login></vue-login>
</div>

```

when the user is logged in, hide the vue-login component

```
@guest
   <vue-login></vue-login>
@endguest

```

using the factory, we can create a user for test purpose

```
$user = User::factory()->create();

```

you can overwite the factory value as:

```
$user = User::factory()->create([
            'password' => bcrypt('laravel'),
        ]);
```

writing the feature test:

```
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

```

to see more valid exception duing the testing use tests without exception handling, this will give more insight of error,
because default laravel exception bubbles out with clean error message if with don't trun off exceptions in tests

```
$this->withoutExceptionHandling();

```

also use refresh database in each test:

```
use RefreshDatabase;
```

also migrate for testing database as:

```
php artisan migrate --env=testing

```

```
$this->assertRedirect() === $this->assertStatus(302)

```

Mail has facade to replace in bound mail with fake email as:

```
Mail::fake();

```

when we rewrite the method that runs after creation of user, add redirect to it also:

```
redirect($this->redirectPath())

```

### confusion about the email test, when commented the user creation, email was not sent

test for asserting the new user has confirm token in its table
I was saving the result of post method in user variable, but it is not true
as we are creating using user::create(). This is method of TestCase class

make the method on the user model to confirm the use ris confirmed or not

```
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

```

in the test, if we update the user, and then apply some assertion on it, we will have same old user.
To pass the test, we have to have the updated copy of the user. By fresh method, get the fresh copy.

```
$user->fresh()

```

in the mail markdown, you can simply use php without {{  }}

to open the login model, pass the session to home page and open the dialog box

```
@if(!empty(Session::get('login')) && Session::get('login') === '1')
<script>
   document.addEventListener('DOMContentLoaded', () => {
      $(function () {
         $('#loginModal').modal('show');
      });
   })
</script>
@endif

```

benifit of custom request is that we can apply middleware to authoriz person,
rather than the if else in controller to check authorized person

To access the parts of the HTTP request, go to Illuminate\Http folder vendors laravel

Also you can seek into the uploaded file functions in uploadedFile.php in Illuminate\Http

---

best case is that the controller should have maximum 2, 3 lines

for example: you can put the roles, storage and creation in the customRequest
