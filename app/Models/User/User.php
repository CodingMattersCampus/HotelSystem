<?php

declare(strict_types = 1);

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

final class User extends Authenticatable
{
    protected $guarded = [];

    protected $hidden = ['password', 'remember_token', 'api_token'];

    public function getFullNameAttribute() : string
    {
        return $this->name;
    }

    public function isActive() : bool
    {
        return (boolean) $this->is_active;
    }
}
