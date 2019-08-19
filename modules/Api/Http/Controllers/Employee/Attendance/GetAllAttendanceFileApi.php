<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Employee\Attendance;

use App\Models\User\Employee\AttendanceFile;
use CodingMatters\Api\Transformers\Employee\Attendance\AttendanceFile as AttendanceFileResource;
use CodingMatters\Api\Transformers\Employee\Attendance\AttendanceFileCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllAttendanceFileApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new AttendanceFileCollection(
                    new AttendanceFileResource(
                        AttendanceFile::orderBy('created_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
