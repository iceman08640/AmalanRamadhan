<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMasjidRequest extends FormRequest
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
            'cap' => ['sometimes', 'nullable', 'file', 'mimes:png', 'max:2048'],
            'ttd' => ['sometimes', 'nullable', 'file', 'mimes:png', 'max:2048'],
            'nama' => ['required', 'string'],
            'takmir' => ['required', 'string'],
            'dukuh' => ['required', 'string'],
            'rt' => ['required', 'string'],
            'rw' => ['required', 'string'],
            'desa' => ['required', 'string'],
            'kecamatan' => ['required', 'string'],
            'kab_kota' => ['required', 'string'],
            'kode_pos' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'cp_nama' => ['required', 'string'],
            'cp_telp' => ['required', 'regex:/(08)[0-9]{9}/'],
            'is_active' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
