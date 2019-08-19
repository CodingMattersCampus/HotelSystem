<?php

namespace CodingMatters\Office\Imports\Employee;

// use App\Models\User\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User\Employee\Attendance;
use Ramsey\Uuid\Uuid;
use App\Models\User\Employee\AttendanceFile;

Collection::macro('toLower', function () {
    return $this->map(function ($value) {
        return Str::lower(trim($value));
    });
});

class AttendanceImport implements ToCollection
{
    protected $import;

    public function __construct(AttendanceFile $import)
    {
        $this->import = $import;
    }
    /**
     * @param array $row
     *
     * @return null
     */
    public function collection(Collection $rows)
    {
        $headers = $rows->first()->toLower();

        if ($headers->contains('name') && $headers->contains('datetime')) {
            $keys = $headers->flip()->only(['name','datetime']);
            $rows->shift(); //removes headers
        } else {
            return ; //stops if there's no basis for data control.
        }

        foreach ($rows as $key => $row) {
            $nameCol = $keys['name'];
            $dtCol = $keys['datetime'];
            $date = Carbon::parse($row[ $dtCol ]);

            $name = preg_replace("/[0-9,\s]/", '', $row[ $nameCol ]); //clear whitespace and numbers

            if (empty($name)) {
                continue;
            }
            //change username here; also, should be employee instance
            // $employee = Employee::firstOrNew([
            //     'username'   => Str::upper( $name ),
            //     'first_name' => ucfirst($name),
            //     'code'       => Uuid::uuid4()->toString(),
            //     'role'       => 'new', //change?
            //     'last_name'  => ucfirst($name),
            //     'password'   => Str::lower( $name )
            // ]);

            $attendance = Attendance::where('employee', Str::upper($name))->whereNull('out')->latest()->first();

            if (! $attendance) {
                Attendance::create([
                    'code'     => Uuid::uuid4()->toString(),
                    'file'     => $this->import->code,
                    'employee' => Str::upper($name),
                    'for_date' => $date->toDateString(),
                    'in'       => $date
                ]);
            } else {
                $attendance->out = $date;
                $attendance->save();
            }

            $this->import->processed += 1;
        }

        $this->import->rows = count($rows);
        $this->import->save();
    }
}
