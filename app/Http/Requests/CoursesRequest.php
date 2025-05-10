<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'category_id' => ['required', 'integer'],
            'title' => ['string', 'required'],
            'tagline' => ['required', 'string'],
            'issue_certificate' => ['required'],
            'image' => ['nullable', 'mimes:png,jpg'],
            'description' => ['nullable'],
            'price' => ['required'],
            'active' => ['required']
        ];
    }
}
