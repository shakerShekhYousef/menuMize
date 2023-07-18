<?php

namespace App\Http\Controllers\dashboard\business;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\spotlightDaily\AddProductsToSpotlightDailyRequest;
use App\Http\Resources\business\SpotlightDailyResource;
use App\Models\SpotlightDaily;
use App\Models\SpotlightDailyType;
use Illuminate\Support\Facades\DB;

class SpotlightDailyController extends Controller
{
    public function index()
    {
        //Get auth business
        $business = auth()->user()->business;
        //Get all spotlight daily
        $spotlight_dailies = $business->spotlight_dailies;
        //Response
        return success_response(SpotlightDailyResource::collection($spotlight_dailies));
    }

    public function add_products_to_spotlight(AddProductsToSpotlightDailyRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Get type
        $type = SpotlightDailyType::findOrFail($request->type_id);
        //Create or update spotlight lists
        $business = auth()->user()->business;
        $spotlight_list = SpotlightDaily::create([
            'business_id' => $business->id,
            'spotlight_daily_type_id' => $type->id,
        ]);
        //Attach products to type
        $spotlight_list->products()->sync($request->products);
        DB::commit();
        //Response
        return success_response('Products has been added successfully');
    }

    //Get products by spotlight type
    public function get_products_by_spotlight_type()
    {
        //Get type id
        $type_id = $_GET['spotlight_daily_type_id'];
        //Get auth business
        $business = auth()->user()->business;
        //Get all spotlight daily
        $spotlight_dailies = $business->spotlight_dailies->where('spotlight_daily_type_id', $type_id);
        //Response
        return success_response(SpotlightDailyResource::collection($spotlight_dailies));
    }
}
