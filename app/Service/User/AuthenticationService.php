<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    /**
     * -----------------------------------------
     *  Login
     * -----------------------------------------
     *  Check the password of the user and generate 
     *  token in case he provide right cred
    **/
    public function login ($request)
    {
        $user = User::where('email',$request->email)->first();

        // Check if user exists
        if (!$user) {
            return [
                'status'  => 'failed',
                'message' => 'Login failed'
            ];
        }

        // Check that the user has the right password
        if (!Hash::check($request->password, $user->password)) {
            return [
                'status'  => 'failed',
                'message' => 'Login failed'
            ];
        }

        // Generate the token and return success payload
        $token = $user->createToken('access_token')->accessToken;
        $user->token = $token;
        
        return [
            'status' => 'success',
            'message' => 'Welcome back',
            'user' => $user
        ];
    }
}
