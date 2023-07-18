<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;

class BusinessTypeController extends Controller
{
    //Get all business types
    public function index()
    {
        //Get all business types
        $business_types = BusinessType::all();
        //Response
        return success_response($business_types);
    }
}
