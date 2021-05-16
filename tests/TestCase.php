<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAdmin()
    {
        $user = User::factory()->create();
        Config::push('app.admins',$user->email);
        $this->actingAs($user);
    }

    public function flushRedis()
    {
        Redis::flushAll();
    }
}
