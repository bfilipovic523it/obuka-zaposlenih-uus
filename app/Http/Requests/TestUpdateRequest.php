<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ocena' => ['required', 'integer'],
            'prijava_id' => ['required', 'integer', 'exists:prijavas,id'],
            'obuka_id' => ['required', 'integer', 'exists:obukas,id'],
        ];
    }
}
