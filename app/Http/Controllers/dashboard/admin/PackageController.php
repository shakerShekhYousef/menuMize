<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\package\PackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //Get all packages
        $packages = Package::all();
        //Response
        return success_response($packages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PackageRequest $request)
    {
        //Begin transaction
        DB::beginTransaction();
        //Create a new package
        $package = Package::create([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'is_popular' => $request->is_popular ?? 0,
            'description' => $request->description,
            'features' => json_encode($request->features),
            'category_limit' => $request->category_limit,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response($package);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Package $package)
    {
        //Response
        return success_response($package);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //Begin transaction
        DB::beginTransaction();
        //update package
        $package->update([
            'type' => $request->type ?? $package->type,
            'name' => $request->name ?? $package->name,
            'price' => $request->price ?? $package->price,
            'is_popular' => $request->is_popular ?? 0,
            'description' => $request->description ?? $package->description,
            'features' => isset($request->features) ? json_encode($request->features) : $package->features,
            'category_limit' => $request->category_limit ?? $package->category_limit,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Package $package)
    {
        //Delete package
        $package->delete();
        //Response
        return success_response('Package has been deleted successfully');
    }
}
