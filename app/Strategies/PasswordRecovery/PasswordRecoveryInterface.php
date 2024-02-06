<?php

namespace App\Strategies\PasswordRecovery;

interface PasswordRecoveryInterface
{
    public function forgot();
    public function reset($identifier, $code, $password);
    
}
