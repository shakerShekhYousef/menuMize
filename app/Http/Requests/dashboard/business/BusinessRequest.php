<?php

namespace App\Http\Requests\dashboard\business;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return match ($this->method()) {
            'POST' => $this->store(),
            'PUT', 'PATCH' => $this->update(),
            'DELETE' => $this->destroy(),
        };
    }

    public function store()
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

    public function update()
    {
        return [
            'business_name' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'share_location' => ['nullable', 'string'],
            'mobile_number' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string'],
            'business_logo' => ['nullable', 'file', 'mimes:jpg,png,jpeg,webp', 'max:10000'],
            'logo_note' => ['nullable', 'string'],
            'business_banner' => ['nullable', 'file', 'mimes:jpg,png,jpeg,webp', 'max:10000'],
            'other_info' => ['nullable', 'string'],
            'country_id' => ['nullable', Rule::exists('countries', 'id')],
            'city_id' => ['nullable', Rule::exists('cities', 'id')],
            'business_type_id' => ['nullable', Rule::exists('business_types', 'id')],
            'package_id' => ['nullable', Rule::exists('packages', 'id')],
            'main_language_id' => ['nullable', Rule::exists('languages', 'id')],
            'second_language_id' => ['nullable', Rule::exists('languages', 'id')],
        ];
    }

    public function destroy()
    {
        return [
            'id' => ['required', 'numeric', Rule::exists('businesses', 'id')],
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
