<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\socialLink\SocialLinkTypeRequest;
use App\Models\SocialLinkType;
use Illuminate\Support\Facades\DB;

class SocialLinkTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = SocialLinkType::all();

        return success_response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SocialLinkTypeRequest $request)
    {
        //Start Transaction
        DB::beginTransaction();
        //create a new type
        $type = SocialLinkType::create([
            'type' => $request->type,
            'icon' => $request->icon,
        ]);
        //Commit transaction
        DB::commit();
        //Response
        return success_response($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SocialLinkType $socialLinkType)
    {
        return success_response($socialLinkType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SocialLinkTypeRequest $request, SocialLinkType $socialLinkType)
    {
        //Start Transaction
        DB::beginTransaction();
        //Update type
        $socialLinkType->update([
            'type' => $request->type ?? $socialLinkType->type,
            'icon' => $request->icon ?? $socialLinkType->icon,
        ]);
        //Commit transaction
        DB::commit();
        //Response
        return success_response($socialLinkType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SocialLinkType $socialLinkType)
    {
        $socialLinkType->delete();

        return success_response('Social Link type has been deleted successfully');
    }
}
