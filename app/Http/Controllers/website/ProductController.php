<?php

namespace App\Http\Controllers\website;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Resources\business\ProductResource;
use App\Models\Business;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws GeneralException
     */
    public function index()
    {
        //Get business id
        if (isset($_GET['business_id'])) {
            $business_id = $_GET['business_id'];
            $business = Business::find($business_id);
        } else {
            throw new GeneralException('please select the business first');
        }
        //Get products
        $products = Product::query()
            ->where('business_id', $business_id)
            ->get();
        //Response
        return success_response(ProductResource::collection($products));
    }
}
