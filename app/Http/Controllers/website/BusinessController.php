<?php

namespace App\Http\Controllers\website;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\website\business\CreateBusinessRequest;
use App\Http\Resources\website\BusinessResource;
use App\Models\Business;
use App\Traits\System\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    //Traits
    use FileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_business_info()
    {
        //Get business id
        if (isset($_GET['business_id'])) {
            $business_id = $_GET['business_id'];
            $business = Business::find($business_id);
        } else {
            throw new GeneralException('please select the business first');
        }
        //Get products and categories
        $data = BusinessResource::make($business);
        //Response
        return success_response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBusinessRequest $request)
    {
        //validating
        $this->validate($request, $request->rules());
        //Start transaction
        DB::beginTransaction();
        //Create new business
        $business = Business::create([
            'address' => $request->address,
            'share_location' => $request->share_location,
            'mobile_number' => $request->mobile_number,
            'phone_number' => $request->phone_number,
            'request_redesign_logo' => $request->request_photoshot ?? 0,
            'logo_note' => $request->logo_note,
            'business_logo' => $this->UploadFile($request->business_logo,
                BUSINESS_LOGO_PATH.'/'.str_replace(' ', '_', $request->business_name)),
            'business_banner' => $this->UploadFile($request->business_banner,
                BUSINESS_BANNER_PATH.'/'.str_replace(' ', '_', $request->business_name)),
            'request_photoshot' => $request->request_photoshot ?? 0,
            'request_new_logo' => $request->request_new_logo ?? 0,
            'do_you_have_delivery' => $request->do_you_have_delivery ?? 0,
            'delivery_company_name' => $request->delivery_company_name,
            'other_info' => $request->other_info,
            'package_id' => $request->package_id,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'business_type_id' => $request->business_type_id,
            'main_language_id' => $request->main_language_id,
            'second_language_id' => $request->second_language_id,
            'other_business_type' => $request->other_business_type,
            'user_id' => $request->user_id,
        ]);
        //Store business name
        $business->business_infos()->create([
            'name' => $request->business_name,
            'description' => $request->description,
            'lang' => app()->getLocale(),
        ]);
        //Store business categories
        if (isset($request->categories)) {
            foreach ($request->categories as $data) {
                $category = $business->categories()->create([
                    'logo' => isset($data['logo']) ?
                        $this->UploadFile($data['logo'],
                            CATEGORY_LOGO_PATH.'/'.
                            str_replace(' ', '_', $request->business_name).'/'.
                            str_replace(' ', '_', $data['name']))
                        : null,
                    'business_id' => $business->id,
                ]);
                $category->category_infos()->create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'lang' => app()->getLocale(),
                ]);
            }
        }
        //commit transaction
        DB::commit();
        //Response
        return success_response(BusinessResource::make($business));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
