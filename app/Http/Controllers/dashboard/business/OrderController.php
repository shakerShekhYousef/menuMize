<?php

namespace App\Http\Controllers\dashboard\business;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\order\ChangeOrderStatusRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //Get business
        $business = auth('api')->user()->business;
        //Get qr_tokens
        $qr_tokens = $business->qr_codes->pluck('token')->toArray();
        //Get orders
        if (isset($_GET['order_status_id'])) {
            $status = $_GET['order_status_id'];
            $orders = Order::query()
                ->whereIn('table_token', $qr_tokens)
                ->with(['order_status', 'cart'])
                ->status($status)
                ->get();
        } else {
            $orders = Order::query()->whereIn('table_token', $qr_tokens)->with(['order_status', 'cart'])->get();
        }
        //Response
        return success_response($orders);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        return success_response($order->with(['order_status', 'cart'])->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ChangeOrderStatusRequest $request, Order $order)
    {
        //start transaction
        DB::beginTransaction();
        //Update order status
        $order->update([
            'order_status_id' => $request->order_status_id,
        ]);
        //Commit
        DB::commit();
        //Response
        return success_response($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();
        //Response
        return success_response('Order has been deleted successfully');
    }
}
