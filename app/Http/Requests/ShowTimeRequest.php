<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowTimeRequest extends FormRequest
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
            'show_time_text' => ['required', 'unique:show_times', 'max:50'],
            'show_time_value' => ['required']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function messages(): array
    {
        return [
            'show_time_text.required' => 'The show time text is a required field',
            'show_time_text.max' => 'Maximum allowed characters for the show time text field is 100',
            'show_time_value.required' => 'The show time text is a required field',
        ];
    }
}
