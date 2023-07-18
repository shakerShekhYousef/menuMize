<?php

namespace App\Http\Requests\website\business;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateBusinessRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'business_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'share_location' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'business_logo' => ['required', 'file', 'mimes:jpg,png,jpeg,webp', 'max:10000'],
            'logo_note' => ['nullable', 'string'],
            'business_banner' => ['nullable', 'file', 'mimes:jpg,png,jpeg,webp', 'max:10000'],
            'other_info' => ['nullable', 'string'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'business_type_id' => ['required', Rule::exists('business_types', 'id')],
            'package_id' => ['required', Rule::exists('packages', 'id')],
            'main_language_id' => ['required', Rule::exists('languages', 'id')],
            'second_language_id' => ['required', Rule::exists('languages', 'id')],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
