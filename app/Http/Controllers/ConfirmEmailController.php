<?php

namespace App\Http\Controllers;

use App\Models\User;

class ConfirmEmailController extends Controller
{
    public function index()
    {
        $user = User::where('confirm_token', request('token'))->first();

        if($user)
        {
            $user->confirm();
            session()->flash('success','Your email has been Confirmed');
            return redirect('/');
        }else{
            session()->flash('error','Confirmation token not recognized');
            return redirect('/');
        }
    }
}
