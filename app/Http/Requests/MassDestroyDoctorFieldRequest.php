<?php

namespace App\Http\Requests;

use App\Models\DoctorField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDoctorFieldRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('doctor_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:doctor_fields,id',
        ];
    }
}
