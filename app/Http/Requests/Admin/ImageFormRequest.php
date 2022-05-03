<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImageFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'images' => ['required'],
            'images.*' => ['mimes:jpeg,jpg,jpe,jfi,jif,jfif,png,gif,bmp,webp,svg'],
            'description' => ['nullable', 'string'],
            'imageable_id' => ['nullable', 'integer'],
            'imageable_type' => ['nullable', 'string'],
        ];
    }
}
