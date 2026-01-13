<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrijavaStoreRequest extends FormRequest
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
            'status' => ['required', 'string', 'max:50'],
            'datum' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'obuka_id' => ['required', 'integer', 'exists:obukas,id'],
        ];
    }
}
