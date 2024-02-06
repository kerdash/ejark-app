<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PhonePasswordRecovery
{
    public function __invoke($_, array $args)
    {
        if(filter_var($args['identifier'], FILTER_VALIDATE_EMAIL)){
            $user = User::where('email', $args['identifier'])->where('email_verified_at', '!=', null)->first();
        }else{
            $user = User::where('phone', $args['identifier'])->where('phone_verified_at', '!=', null)->first();
        }

        if (!$user || !Hash::check($args['password'], $user->password))
            throw ValidationException::withMessages([__('The provided credentials are incorrect')]);

        return $user->createToken('auth token')->plainTextToken;
    }
}