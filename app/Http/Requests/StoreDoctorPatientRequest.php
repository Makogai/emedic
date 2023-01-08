<?php

namespace App\Http\Requests;

use App\Models\DoctorPatient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorPatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_patient_create');
    }

    public function rules()
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
