<?php

namespace App\Http\Controllers\website;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Resources\business\ProductResource;
use App\Http\Resources\website\CategoryResource;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        //Get business id
        if (isset($_GET['business_id'])) {
            $business_id = $_GET['business_id'];
        } else {
            throw new GeneralException('please select the business first');
        }
        //Get all categories
        $categories = Category::query()->where('business_id', $business_id)->get();
        //Response
        return success_response(CategoryResource::collection($categories));
    }

    public function get_products_of_category()
    {
        //Validator
        validator(request()->all(), [
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'business_id' => ['required', Rule::exists('businesses', 'id')],
        ])->validate();
        //Get category
        $category = Category::findOrFail(request()->category_id);
        //Get products
        $business_id = request()->business_id;
        //Query
        $products = $category->products()->whereHas('business', function ($query) use ($business_id) {
            $query->where('id', $business_id);
        })->get();
        //Response
        return success_response(ProductResource::collection($products));
    }
}
