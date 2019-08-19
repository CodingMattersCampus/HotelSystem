<?php

namespace App\Models\User\Employee;

use Illuminate\Database\Eloquent\Model;

final class Attendance extends Model
{
    protected $guarded = [];

    public function employee()
    {
    }

    public function imported()
    {
    }

    //Get Recent where out is null.
}
