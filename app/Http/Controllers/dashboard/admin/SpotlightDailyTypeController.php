<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\spotlightDaily\SpotlightDailyTypeRequest;
use App\Models\SpotlightDailyType;
use Illuminate\Support\Facades\DB;

class SpotlightDailyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $types = SpotlightDailyType::all();

        return success_response($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SpotlightDailyTypeRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //create a new type
        $type = SpotlightDailyType::create([
            'name' => $request->name,
            'lang' => app()->getLocale(),
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
    public function show(SpotlightDailyType $spotlightDailyType)
    {
        return success_response($spotlightDailyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SpotlightDailyTypeRequest $request, SpotlightDailyType $spotlightDailyType)
    {
        //Start transaction
        DB::beginTransaction();
        //Update spotlight daily type
        $spotlightDailyType->update([
            'name' => $request->name ?? $spotlightDailyType->name,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response($spotlightDailyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SpotlightDailyType $spotlightDailyType)
    {
        $spotlightDailyType->delete();

        return success_response('Spotlight daily type has been deleted successfully');
    }
}
