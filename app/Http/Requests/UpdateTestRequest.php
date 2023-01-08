<?php

namespace App\Http\Requests;

use App\Models\Test;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('test_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:3',
                'max:150',
                'required',
            ],
            'file' => [
                'array',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'doctor_id' => [
                'required',
                'integer',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
            'tip' => [
                'string',
                'min:1',
                'max:150',
                'required',
            ],
        ];
    }
}
