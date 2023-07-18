<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\order\AddProductsToCartRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //Add products to cart
    public function add_product_to_cart(AddProductsToCartRequest $request)
    {
        //initial amount
        $amount = 0;
        //Start transaction
        DB::beginTransaction();
        //Open cart or Update cart
        $cart = Cart::updateOrCreate(
            [
                'table_token' => $request->table_token,
            ],
            [
                'table_token' => $request->table_token,
                'amount' => $request->amount,
            ]
        );
        //Add products to cart
        $cart->products()->sync($request->products);
        //Commit
        DB::commit();
        //Response
        return success_response($cart);
    }
}
