<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
            'lastname' => ['required', 'string' , 'min:2', 'max:50'],
            'firstname' => ['required', 'string' , 'min:2', 'max:50'],
            'patronymic' => ['required', 'string' , 'min:2', 'max:50'],
            'date_of_birth' => 'date',
        ];
    }
}
