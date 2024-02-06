<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

class Register
{
    public function __invoke($_, array $args)
    {
        User::create([
          "name" => $args['name'],
          "email" => $args['email'], 
          "phone" => $args['phone'],
          "phone_country_code" => $args['phone_country_code'],
          "account_type" => $args['account_type'],
          "password" => $args['password'],
        ]);

        return __('Verification code has been sent');
    }
}