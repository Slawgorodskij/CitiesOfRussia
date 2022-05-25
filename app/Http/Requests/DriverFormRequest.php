<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverFormRequest extends FormRequest
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
            'driving_license' => ['required', 'string' , 'min:1', 'max:50'],
            'car' => ['required', 'string'],
            'registration_number' => ['required', 'string'],
            'vehicle_registration_certificate' => ['required', 'string'],
            'document_verification' => ['required'],
        ];
    }
}
