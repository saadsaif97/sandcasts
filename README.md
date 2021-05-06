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
