<?php

namespace App\Http\Repositories;

use App\Models\User;
use Modules\Auth\app\Models\PasswordRecoveryToken;

class PasswordRecoveryTokenRepository
{
    public function create($identifier, $identifier_type, $code)
    {
        PasswordRecoveryToken::where("identifier", $identifier)->where("identifier_type", $identifier_type)->delete();

        PasswordRecoveryToken::insert([
            'identifier' => $identifier,
            'identifier_type' => $identifier_type,
            'token' => hash('sha512', $code),
            'created_at' => now()
        ]);
    }

    public function verify($identifier, $identifier_type, $code)
    {
        $password_recovery = PasswordRecoveryToken::where("identifier", $identifier)
            ->where("identifier_type", $identifier_type)
            ->where("token", hash('sha512', $code))
            ->first();

        if (!$password_recovery)
            return false;

        return true;
    }

    public function reset($identifier, $identifier_type, $code)
    {
        if (!$this->verify($identifier, $identifier_type, $code))
            return false;

        return PasswordRecoveryToken::where("identifier", $identifier)->where("identifier_type", $identifier_type)->delete();
    }
}