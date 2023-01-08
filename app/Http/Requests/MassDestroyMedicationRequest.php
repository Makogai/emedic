<?php

namespace App\Http\Requests;

use App\Models\Medication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMedicationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('medication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:medications,id',
        ];
    }
}
