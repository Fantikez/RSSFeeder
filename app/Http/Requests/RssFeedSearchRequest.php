<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RssFeedSearchRequest extends FormRequest
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
            'search' => 'nullable|string|max:255',
            'filters' => 'nullable|array',
            'filters.id' => 'nullable|integer|min:1',
            'filters.title' => 'nullable|string|max:255',
            'filters.link' => 'nullable|string|max:255',
            'filters.description' => 'nullable|string|max:255',
            'filters.pub_date' => 'nullable|array',
            'filters.pub_date.from' => 'nullable|date|before_or_equal:filters.pub_date.to',
            'filters.pub_date.to' => 'nullable|date|after_or_equal:filters.pub_date.from|before_or_equal:today',
            'sort' => 'required|array',
            'sort.sort_by' => 'nullable|string|in:id,title,link,pub_date',
            'sort.sort_order' => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ];
    }
}
