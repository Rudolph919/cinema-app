<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'cinema-company' => ['required', 'string', 'max:100'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function messages(): array
    {
        return [
            'cinema-company.required' => 'The cinema company name is a required field',
            'cinema-company.max' => 'Maximum allowed characters for the cinema company field is 100'
        ];
    }
}
