<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\orderStatus\OrderStatusRequest;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //Get all Order Status
        $data = OrderStatus::all();
        //Response
        return success_response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStatusRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //create a new status
        $status = OrderStatus::create([
            'name' => $request->name,
            'lang' => app()->getLocale(),
        ]);
        //Commit transaction
        DB::commit();
        //Response
        return success_response($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(OrderStatus $orderStatus)
    {
        return success_response($orderStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderStatusRequest $request, OrderStatus $orderStatus)
    {
        //Start transaction
        DB::beginTransaction();
        //Update status
        $orderStatus->update([
            'name' => $request->name ?? $orderStatus->name,
            'lang' => app()->getLocale(),
        ]);
        DB::commit();
        //Response
        return success_response($orderStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();

        return success_response('Order status has been deleted successfully');
    }
}
