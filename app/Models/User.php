<?php

namespace App\Models;

use App\Entities\Learning;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, Learning;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'confirm_token',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Confirmed the email
     */
    public function isConfirmed()
    {
        return $this->confirm_token === null;
    }

    /**
     * Confirms the user by removing the token
     */
    public function confirm()
    {
        $this->confirm_token = null;
        $this->save();
    }

    /**
     * Confirms user is admin by looking admins array in app config
     */

    public function isAdmin()
    {
        return in_array($this->email,config('app.admins'));
    }

}
