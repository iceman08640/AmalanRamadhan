<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateKultumRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'masjid_id' => ['required', 'uuid', 'exists:masjid,id'],
            'agenda_id' => ['required', 'uuid', 'exists:agenda,id'],
            'imam_ustadz_id' => ['nullable', 'uuid', 'exists:ustadz,id'],
            'kultum_ustadz_id' => ['nullable', 'uuid', 'exists:ustadz,id'],
            'kulsub_ustadz_id' => ['nullable', 'uuid', 'exists:ustadz,id'],
        ];
    }
}
