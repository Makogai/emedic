<?php

namespace App\Http\Requests;

use App\Models\DoctorField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_field_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:doctor_fields',
            ],
            'title' => [
                'string',
                'min:1',
                'max:100',
                'required',
            ],
        ];
    }
}
