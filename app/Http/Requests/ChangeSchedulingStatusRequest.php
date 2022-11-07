<?php

namespace App\Http\Requests;

use App\Models\SchedulingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeSchedulingStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'scheduling_status_id' => [
                'required',
                Rule::in([
                    SchedulingStatus::CREATED,
                    SchedulingStatus::ACCEPTED,
                    SchedulingStatus::IN_PROGRESS,
                    SchedulingStatus::FINISHED
                ]),
            ]
        ];
    }
}
