<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\business\BusinessRequest;
use App\Http\Resources\admin\BusinessResource;
use App\Models\Business;
use App\Models\User;
use App\Traits\System\FileTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class BusinessController extends Controller
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
        //Get all business
        $businesses = Business::all();
        //Response
        return success_response(BusinessResource::collection($businesses));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BusinessRequest $request)
    {
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
                            CATEGORY_LOGO_PATH.'/'.str_replace(' ', '_', $request->business_name).'/'.str_replace(' ', '_', $data['name']))
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Business $business)
    {
        //Response
        return success_response(BusinessResource::make($business));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BusinessRequest $request, Business $business)
    {
        //Start transaction
        DB::beginTransaction();
        $name = $request->business_name ?? $business->name;
        //Create new business
        $business->update([
            'address' => $request->address ?? $business->address,
            'share_location' => $request->share_location ?? $business->share_location,
            'mobile_number' => $request->mobile_number ?? $business->mobile_number,
            'phone_number' => $request->phone_number ?? $business->phone_number,
            'request_redesign_logo' => $request->request_photoshot ?? 0,
            'logo_note' => $request->logo_note ?? $business->logo_note,
            'business_logo' => isset($request->business_logo) ?
                $this->Updatefile($request->business_logo,
                    BUSINESS_BANNER_PATH.'/'.str_replace(' ', '_', $name),
                    $business->business_logo) :
                $business->business_logo,
            'business_banner' => isset($request->business_banner) ?
                $this->Updatefile($request->business_banner,
                    BUSINESS_BANNER_PATH.'/'.str_replace(' ', '_', $name),
                    $business->business_banner) :
                $business->business_banner,
            'request_photoshot' => $request->request_photoshot ?? 0,
            'do_you_have_delivery' => $request->do_you_have_delivery ?? 0,
            'delivery_company_name' => $request->delivery_company_name ?? $business->delivery_company_name,
            'other_info' => $request->other_info ?? $business->other_info,
            'package_id' => $request->package_id ?? $business->package_id,
            'city_id' => $request->city_id ?? $business->city_id,
            'country_id' => $request->country_id ?? $business->country_id,
            'business_type_id' => $request->business_type_id ?? $business->business_type_id,
            'main_language_id' => $request->main_language_id ?? $business->main_language_id,
            'second_language_id' => $request->second_language_id ?? $business->second_language_id,
            'other_business_type' => $request->other_business_type ?? $business->other_business_type,
            'user_id' => $request->user_id ?? $business->user_id,
        ]);
        //Store business name
        $business->business_infos()->updateOrCreate(
            [
                'name' => $request->business_name ?? $business->name,
                'lang' => app()->getLocale(),
            ],
            [
                'name' => $request->business_name ?? $business->name,
                'lang' => app()->getLocale(),
                'description' => $request->description ?? $business->description,
            ]
        );
        //Store business categories
        if (isset($request->categories)) {
            foreach ($request->categories as $data) {
                $category = $business->categories()->updateOrCreate([
                    'logo' => isset($data['logo']) ?
                        $this->UploadFile($data['logo'],
                            CATEGORY_LOGO_PATH.'/'.str_replace(' ', '_', $name).'/'.$data['name'])
                        : null,
                    'business_id' => $business->id,
                ]);
                $category->category_infos()->updateOrCreate([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'lang' => app()->getLocale(),
                ]);
            }
        }
        //Get role
        $role = Role::where('name', $request->account_type)->first();
        //Find user
        $user = User::findOrFail($request->user_id);
        //Assign role
        $user->syncRoles($role);
        //commit transaction
        DB::commit();
        //Response
        return success_response(BusinessResource::make($business));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Business $business)
    {
        //Begin transaction
        DB::beginTransaction();
        //Delete business logo
        unlink('storage/'.$business->business_logo);
        //Delete business banner image
        unlink('storage/'.$business->business_banner);
        //Delete business
        $business->delete();
        DB::commit();
        //Response
        return success_response('Business has been deleted successfully');
    }
}
