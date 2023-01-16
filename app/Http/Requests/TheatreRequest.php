<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TheatreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'theatre_name' => ['required', 'string', 'max:100'],
            'theatre_cinema' => ['exists:cinemas,id'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function messages(): array
    {
        return [
            'theatre_name.required' => 'The cinema name is a required field',
            'theatre_name.max' => 'Maximum allowed characters for the cinema field is 100',
            'theatre_cinema.exist' => 'The selected cinema does not exist in the database'
        ];
    }
}
