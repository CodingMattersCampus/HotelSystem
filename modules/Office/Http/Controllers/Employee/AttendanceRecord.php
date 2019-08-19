<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Office\Http\Requests\Employee\AttendanceRecordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use CodingMatters\Office\Imports\Employee\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User\Employee\AttendanceFile;
use Illuminate\Support\Facades\Session;

final class AttendanceRecord extends Controller
{
    public function __invoke(AttendanceRecordRequest $request) : RedirectResponse
    {
        $file = $request->file('attendance');
        //
        $afInstance = AttendanceFile::create([
            'code'    => Uuid::uuid4()->toString(),
            'name'    => $file->getClientOriginalName(),
            'from'     => $request->post('from'),
            'to'       => $request->post('to'),
            'contents' => $file->get(),
        ]);

        $import = Excel::import(new AttendanceImport($afInstance), $file);

        Session::flash('uploaded', 'File successfully processed');

        return redirect(
            route('office.employee.attendance')
        );
    }
}
