<?php

namespace App\Http\Controllers\dashboard\business;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\business\UpdateProfileRequest;
use App\Http\Requests\dashboard\socialLink\UpdateBusinessSocialLinkRequest;
use App\Http\Resources\admin\BusinessResource;
use App\Models\Business;
use App\Models\BusinessSocialLink;
use App\Traits\System\FileTrait;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    use FileTrait;

    public function update_profile(UpdateProfileRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Get auth business
        $business = auth()->user()->business;
        $name = $request->business_name ?? $business->name;
        //Update profile
        $business->update([
            'address' => $request->address ?? $business->address,
            'share_location' => $request->share_location ?? $business->share_location,
            'mobile_number' => $request->mobile_number ?? $business->mobile_number,
            'phone_number' => $request->phone_number ?? $business->phone_number,
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
            ]);
        //Store business categories
        if (isset($request->categories)) {
            foreach ($request->categories as $data) {
                $category = $business->categories()->updateOrCreate([
                    'logo' => isset($data['logo']) ?
                        $this->UploadFile($data['logo'],
                            CATEGORY_LOGO_PATH.'/'.str_replace(' ', '_', $name).'/'.str_replace(' ', '_', $data['name']))
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
        //Update social links
        if (isset($request->social_links)) {
            foreach ($request->social_links as $data) {
                $links = $business->social_links()->updateOrCreate(
                    [
                        'link' => $data['link'],
                        'social_link_type_id' => $data['type_id'],
                    ],
                    [
                        'link' => $data['link'],
                        'social_link_type_id' => $data['type_id'],
                    ]
                );
            }
        }
        //commit transaction
        DB::commit();
        //Response
        return success_response(BusinessResource::make($business));
    }

    public function update_social_links(UpdateBusinessSocialLinkRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Get business
        $business = auth()->user()->business;
        //Update business social links
        $data = BusinessSocialLink::updateOrCreate(
            [
                'social_link_type_id' => $request->type_id,
            ],
            [
                'link' => $request->link,
                'social_link_type_id' => $request->type_id,
                'business_id' => $business->id,
            ]
        );
        //Commit
        DB::commit();
        //Response
        return success_response($data);
    }
}
