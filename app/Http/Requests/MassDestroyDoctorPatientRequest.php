<?php

namespace App\Http\Requests;

use App\Models\DoctorPatient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDoctorPatientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('doctor_patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:doctor_patients,id',
        ];
    }
}
