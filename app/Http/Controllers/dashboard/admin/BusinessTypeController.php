<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\business\BusinessTypeRequest;
use App\Models\BusinessType;
use App\Traits\System\FileTrait;
use Illuminate\Support\Facades\DB;

class BusinessTypeController extends Controller
{
    //Traits
    use FileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //Get all business types
        $business_types = BusinessType::all();
        //Response
        return success_response($business_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BusinessTypeRequest $request)
    {
        //Begin transaction
        DB::beginTransaction();
        //Create a new business type
        $business_type = BusinessType::create([
            'name' => $request->name,
            'logo' => $this->UploadFile($request->logo, BUSINESS_TYPE_PATH),
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response($business_type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BusinessType $businessType)
    {
        //Response
        return success_response($businessType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BusinessTypeRequest $request, BusinessType $businessType)
    {
        //Begin transaction
        DB::beginTransaction();
        //Update business type
        $businessType->updateOrCreate([
            'name' => $request->name,
            'logo' => isset($request->logo) ?
                $this->Updatefile($request->logo, BUSINESS_TYPE_PATH, $businessType->logo) :
                $businessType->logo,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response($businessType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BusinessType $businessType)
    {
        //Begin transaction
        DB::beginTransaction();
        //Delete image
        unlink('storage/'.$businessType->logo);
        //Delete business type
        $businessType->delete();
        DB::commit();
        //Response
        return success_response('Business type has been deleted successfully');
    }
}
