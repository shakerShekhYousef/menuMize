<?php

namespace App\Http\Requests\dashboard\spotlightDaily;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddProductsToSpotlightDailyRequest extends FormRequest
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
        return [
            'products.*' => ['required', Rule::exists('products', 'id')],
            'type_id' => ['required', Rule::exists('spotlight_daily_types', 'id')],
        ];
    }
}
