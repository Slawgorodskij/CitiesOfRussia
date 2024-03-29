<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripFormRequest extends FormRequest
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
            "departure_city" => ['required', 'exists:cities,name'],
            "city_of_arrival" => ['required', 'exists:cities,name'],
            "driver" => ['nullable', 'integer'],
            "passenger_first" => ['nullable', 'integer'],
            "passenger_two" => ['nullable', 'integer'],
            "passenger_three" => ['nullable', 'integer'],
            "start" => ['required', 'date'],
            "finish" => ['required', 'date'],
        ];
    }
}
