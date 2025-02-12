<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RssFeedApiStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'link' => 'required|string',
            'pub_date' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'link.required' => 'Link is required',
            'pub_date.required' => 'Publish date is required',
        ];
    }
}
