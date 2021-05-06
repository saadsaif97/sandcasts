<?php

namespace App\Exceptions;

use Exception;

class AuthFailedException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            "message"=> "These credentials do not match our records."
        ], 422);
    }
}
