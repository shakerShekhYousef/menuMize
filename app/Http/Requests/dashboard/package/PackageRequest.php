<?php

namespace App\Http\Requests\dashboard\package;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class PackageRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'features' => ['required', 'string'],
            'category_limit' => ['required', 'numeric'],
        ];
    }

    public function update()
    {
        return [
            'type' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],
            'features' => ['nullable', 'string'],
            'category_limit' => ['nullable', 'numeric'],
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
