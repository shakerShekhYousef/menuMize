<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\order\OrderNowRequest;
use App\Http\Resources\website\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //Order now function
    public function order_now(OrderNowRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Get Cart
        $cart = Cart::findOrFail($request->cart_id);
        //Store in order table
        $order = Order::updateOrCreate(
            [
                'table_token' => $cart->table_token,
            ],
            [
                'amount' => $cart->amount,
                'order_num' => '#ORDER_'.md5(rand()),
                'table_token' => $cart->table_token,
                'order_status_id' => 1,
                'cart_id' => $cart->id,
            ]
        );
        //Commit
        DB::commit();
        //Response
        return success_response($order);
    }

    //Get order details
    public function order_details()
    {
        if (! isset($_GET['table_token'])) {
            return error_response('Please enter table token first.');
        } else {
            $table_token = $_GET['table_token'];
            $orders = Order::query()->where('table_token', $table_token)->with(['cart', 'order_status'])->get();

            return success_response(OrderResource::collection($orders));
        }
    }

    //Request the check
    public function request_the_check(Order $order)
    {
        //Start transaction
        DB::beginTransaction();
        //Get status
        $status = OrderStatus::query()->status(app()->getLocale(), 'Check Requested')->first();
        //Update order status
        $order->update([
            'order_status_id' => $status->id,
        ]);
        //Commit
        DB::commit();
        //Response
        return success_response($order);
    }
}
