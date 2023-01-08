<?php

namespace App\Http\Requests;

use App\Models\Medication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMedicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medication_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:1',
                'max:150',
                'required',
            ],
            'purpose' => [
                'required',
            ],
            'usage' => [
                'required',
            ],
            'doctor_id' => [
                'required',
                'integer',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
