<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class isUniqueUsername implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // if username found return false
        $username = Str::slug($value);
        $user = User::where('username', $username)->first();

        return !$user;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'username has already been taken.';
    }
}
