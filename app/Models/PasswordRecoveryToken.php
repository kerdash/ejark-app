<?php

namespace Modules\Auth\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordRecoveryToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'identifier_type',
        'token',
        'created_at',
    ];

    protected $dates = [
        'created_at',
    ];
}