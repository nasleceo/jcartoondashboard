<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TvRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'tmdbid' => 'required',
            'poster' => 'required',
            'year' => 'numeric',
            'agerate' => 'required',
            'story' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'tmdbid' => 'الرمز ضروري',
            'title' => 'العنوان ضروري',
            'poster' => 'رابط البوستر ضروري',
            'agerate' => 'يجب اختيار العمر المناسب',
            'story' => 'أدخل قصة العمل',
        ];
    }



}
