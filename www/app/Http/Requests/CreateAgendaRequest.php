<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgendaRequest extends FormRequest
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
            'waktu' => ['sometimes', 'date_format:H:i'],
            'tgl' => ['required', 'date', 'date_format:Y-m-d'],
            'is_takjil' => ['sometimes', 'required', 'boolean'],
            'is_kultum' => ['sometimes', 'required', 'boolean'],
            'is_malam_takbir' => ['sometimes', 'required', 'boolean'],
            'is_active' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
