<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Employee\Attendance;

use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;

final class Attendance extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'for_date' => Carbon::parse($this->for_date)->toFormattedDateString(),
            'in' => Carbon::parse($this->in)->toTimeString(),
            'out' => Carbon::parse($this->out)->toTimeString(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
        return parent::toArray($request);
    }
}
