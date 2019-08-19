<?php

declare(strict_types = 1);

namespace App\Models\User;

use App\Models\Cash\Drawer;
use Illuminate\Foundation\Auth\User as Authenticatable;

final class Employee extends Authenticatable
{
    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    public function getRouteKeyName() : string
    {
        return "code";
    }

    public function firstName() : string
    {
        return $this->first_name;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function isCashierOnDuty() : bool
    {
        $drawer = Drawer::latest()
            ->where(['cashier' => $this->code, 'remitted' => false, 'logged_out' => false])
            ->get();

        return $drawer->count() > 0;
    }

    public function getDrawer() : Drawer
    {
        return Drawer::latest()
            ->where(['cashier' => $this->code, 'remitted' => false, 'logged_out' => false])
            ->first();
    }

    public static function getNameByCode(string $code) : string
    {
        return optional(self::whereCode($code)->first())->fullname;
    }

    public function isActive() : bool
    {
        return (boolean) $this->is_active;
    }

    public function profilePhoto() : string
    {
        $path = file_exists('images/'. $this->code . '/profile.jpeg');
        return $path ? asset('images/'. $this->code . '/profile.jpeg') : asset('images/no-image.jpg');
    }
}
