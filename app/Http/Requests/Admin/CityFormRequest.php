<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityFormRequest extends FormRequest
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
            'name' => ['required', 'string' , 'min:2', 'max:50'],
            'description' => ['required', 'string' , 'min:10', 'max:100'],
            'images' => ['nullable'],
            'images.*' => ['mimes:jpeg,jpg,jpe,jfi,jif,jfif,png,gif,bmp,webp,svg'],
        ];
    }
}
