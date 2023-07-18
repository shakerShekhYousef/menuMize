<?php

namespace App\Http\Controllers\dashboard\business;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\category\CategoryRequest;
use App\Http\Resources\website\CategoryResource;
use App\Models\Category;
use App\Traits\System\FileTrait;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        //Get business
        $business = auth('api')->user()->business;
        //Get all categories of business
        $categories = $business->categories;
        //Response
        return success_response(CategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        //Begin transaction
        DB::beginTransaction();
        //Get auth business
        $business = auth('api')->user()->business;
        //Create a new Category
        $category = $business->categories()->create([
            'logo' => $this->UploadFile($request->logo, CATEGORY_LOGO_PATH.'/'.$request->name),
        ]);
        //Add category infos
        $category->category_infos()->create([
            'name' => $request->name,
            'description' => $request->description,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response(CategoryResource::make($category));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        //Get category
        return success_response(CategoryResource::make($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //Begin transaction
        DB::beginTransaction();
        //Get auth business
        $business = auth('api')->user()->business;
        //Create a new Category
        $category->update([
            'logo' => isset($request->logo) ? $this->Updatefile($request->logo, CATEGORY_LOGO_PATH.'/'.$request->name,
                $category->logo) : $category->logo,
        ]);
        //Add category infos
        $category->category_infos()->updateOrCreate([
            'name' => $request->name ?? $category->name,
            'description' => $request->description ?? $category->description,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response(CategoryResource::make($category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        //Begin transaction
        DB::beginTransaction();
        //Delete image
        unlink('storage/'.$category->logo);
        //Delete category
        $category->delete();
        DB::commit();
        //Response
        return success_response('Category has been deleted successfully');
    }
}
