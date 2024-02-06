<?php

namespace App\Strategies\PasswordRecovery;

class PhonePasswordRecoveryStrategy
{
    public function forgot()
    {
        return true;
    }

    public function reset($identifier, $code, $password)
    {
        return true;
    }
}