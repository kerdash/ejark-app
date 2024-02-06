<?php

namespace App\GraphQL\Mutations;

class Logout
{
    public function __invoke($_, array $args)
    {
        auth()->user()->currentAccessToken()->delete();

        return __('You are logged out');
    }
}