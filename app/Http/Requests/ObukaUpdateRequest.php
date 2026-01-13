<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObukaUpdateRequest extends FormRequest
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
            'naziv' => ['required', 'string', 'max:150'],
            'opis' => ['required', 'string'],
            'broj_mesta' => ['required', 'integer'],
            'datum_pocetka' => ['required', 'date'],
            'datum_zavrsetka' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'sektor_id' => ['required', 'integer', 'exists:sektors,id'],
            'materijal_id' => ['required', 'integer', 'exists:materijals,id'],
        ];
    }
}
