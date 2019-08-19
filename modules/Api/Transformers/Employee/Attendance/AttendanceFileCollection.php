<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Employee\Attendance;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class AttendanceFileCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
