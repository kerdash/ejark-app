<?php

namespace App\Strategies\PasswordRecovery;

use App\Emails\PasswordRecoveryMail;
use Illuminate\Support\Facades\Mail;
use App\Actions\ActivationCodeAction;
use App\Http\Repositories\PasswordResetTokenRepository;

class EmailPasswordRecoveryStrategy implements PasswordRecoveryInterface
{

    public function __construct(
        protected $identifier_type = 'email',
        protected PasswordResetTokenRepository $passwordResetTokenRepository
    ) {}

    public function forgot()
    {
        $activation_code = new ActivationCodeAction;

        $user = auth()->user();

        $this->passwordResetTokenRepository->create($user->email, $this->identifier_type, $activation_code);

        try {
            Mail::to($user->email)->send(new PasswordRecoveryMail($activation_code));
        } catch (\Exception $e) {
        }
    }

    public function verify($identifier, $identifier_type, $code)
    {
        // $this->passwordResetTokenRepository->reset($identifier, $identifier_type, $code, $password)
    }

    public function reset($identifier, $code, $password)
    {
        $user = auth()->user();

        $this->passwordResetTokenRepository->reset($identifier, $this->identifier_type, $code);

        return $user->update([
            'password' => $password,
            'phone_verified_at' => now()
        ]);
    }
}