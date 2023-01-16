<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
            'film_name' => ['required', 'string', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function messages(): array
    {
        return [
            'film_name.required' => 'The cinema name is a required field',
            'film_name.max' => 'Maximum allowed characters for the cinema field is 100',
            'start_date.required' => 'The start date is a required field',
            'end_date.required' => 'The end date is a required field',
        ];
    }
}
