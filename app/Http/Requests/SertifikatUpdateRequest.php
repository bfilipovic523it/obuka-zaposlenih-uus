<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SertifikatUpdateRequest extends FormRequest
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
            'kod' => ['required', 'string', 'max:20', 'unique:sertifikats,kod'],
            'datum_izdavanja' => ['required', 'date'],
            'prijava_id' => ['required', 'integer', 'exists:prijavas,id'],
        ];
    }
}
