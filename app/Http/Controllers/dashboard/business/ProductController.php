<?php

namespace App\Http\Controllers\dashboard\business;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\product\AddProductToCategoryRequest;
use App\Http\Requests\dashboard\product\ProductRequest;
use App\Http\Resources\business\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\System\FileTrait;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        //Get auth business
        $business = auth('api')->user()->business;
        //Get all products
        $products = $business->products;
        //Response
        return success_response(ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Get auth business
        $business = auth()->user()->business;
        //Create a new product
        $product = $business->products()->create([
            'image' => $this->UploadFile($request->image, PRODUCT_IMG_PATH),
            'price' => $request->price,
            'estimated_time' => $request->estimated_time,
        ]);
        //Add name and description
        $product->product_infos()->create([
            'name' => $request->name,
            'description' => $request->description,
            'lang' => app()->getLocale(),
        ]);
        //Add ingredients
        if (isset($request->ingredients)) {
            foreach ($request->ingredients as $ingredient) {
                $product->product_ingredients()->create([
                    'name' => $ingredient['name'],
                    'lang' => app()->getLocale(),
                ]);
            }
        }
        DB::commit();

        return success_response(ProductResource::make($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return success_response(ProductResource::make($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        //Start transaction
        DB::beginTransaction();
        //Create a new product
        $product->update([
            'image' => isset($request->image) ? $this->Updatefile($request->image,
                PRODUCT_IMG_PATH,
                $product->image,
            ) : $product->image,
            'price' => $request->price ?? $product->price,
            'estimated_time' => $request->estimated_time ?? $product->estimated_time,
        ]);
        //Add name and description
        $product->product_infos()->update([
            'name' => $request->name,
            'description' => $request->description,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Data to send
        $product['product_infos'] = $product->product_infos;

        return success_response(ProductResource::make($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        //Begin transaction
        DB::beginTransaction();
        //Delete image
        unlink('storage/'.$product->image);
        //Delete the product
        $product->delete();
        //Response
        return success_response('This product has been deleted successfully');
    }

    //Add products to category function
    public function add_products_to_category(AddProductToCategoryRequest $request)
    {
        //Begin transaction
        DB::beginTransaction();
        //Get category
        $category = Category::findOrFail($request->category_id);
        //Attach products to category
        $category->products()->sync($request->products);
        DB::commit();
        //Response
        return success_response('Products has been added successfully');
    }
}
