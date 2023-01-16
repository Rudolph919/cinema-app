<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaRequest extends FormRequest
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
            'cinema_name' => ['required', 'string', 'max:100'],
            'cinema_location' => ['required', 'string', 'max:100'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function messages(): array
    {
        return [
            'cinema_*.required' => 'The cinema name is a required field',
            'cinema_*.max' => 'Maximum allowed characters for the cinema field is 100'
        ];
    }
}
