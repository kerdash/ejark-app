<?php

namespace App\Actions;

class ActivationCodeAction
{
    public function __invoke(){
        return rand(1000, 9999);
    }
}
