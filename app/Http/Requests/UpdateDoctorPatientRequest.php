<?php

namespace App\Http\Requests;

use App\Models\DoctorPatient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDoctorPatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_patient_edit');
    }

    public function rules()
    {
        return [
            'patient_id' => [
                'required',
                'integer',
            ],
            'doctor_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
