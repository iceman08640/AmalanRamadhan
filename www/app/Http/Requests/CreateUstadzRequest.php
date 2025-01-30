<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUstadzRequest extends FormRequest
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
            'nama' => ['required', 'string'],
            'alamat' => ['nullable', 'string'],
            'url_maps' => ['nullable', 'url'],
            'no_telp' => ['nullable', 'regex:/(08)[0-9]{9}/'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
