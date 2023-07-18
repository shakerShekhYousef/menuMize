<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Resources\business\SpotlightDailyResource;
use App\Models\Business;

class SpotlightDailyController extends Controller
{
    public function get_spotlight_daily_list()
    {
        //Get business id
        $business_id = $_GET['business_id'];
        $business = Business::findOrFail($business_id);
        //Get all spotlight daily
        $spotlight_dailies = $business->spotlight_dailies;
        //Response
        return success_response(SpotlightDailyResource::collection($spotlight_dailies));
    }

    //Get products by spotlight type
    public function get_products_by_spotlight_type()
    {
        //Get type id
        $type_id = $_GET['spotlight_daily_type_id'];
        //Get business id
        $business_id = $_GET['business_id'];
        $business = Business::findOrFail($business_id);
        //Get all spotlight daily
        $spotlight_dailies = $business->spotlight_dailies->where('spotlight_daily_type_id', $type_id);
        //Response
        return success_response(SpotlightDailyResource::collection($spotlight_dailies));
    }
}
