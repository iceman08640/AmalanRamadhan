<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportPdfDownloadRequest extends FormRequest
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
            'mode' => ['required', 'string', 'in:blangko_kosong,lembar_permohonan,jadwal'],
            'tipe' => ['required', 'string', 'in:takjil,kultum'],
            'masjid_id' => ['required', 'uuid', 'exists:masjid,id'],
            'agenda_id' => ['nullable', 'uuid', 'exists:agenda,id'],
            'ustadz_id' => ['nullable', 'uuid', 'exists:ustadz,id'],
            'nama_warga' => ['nullable', 'string', 'exists:takjil,nama'],
            'is_include_lampiran' => ['sometimes', 'required', 'boolean']
        ];
    }
}
