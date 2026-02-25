<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_list = Order::all()->withOrderItems();

        return $order_list;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try{
            DB::beginTransaction();
            
            $order = Order::create($request->validated());
            $order->create();
            OrderItem::createMany($request->orderItems);

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            return $e;
        }
        
        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try{
            DB::beginTransaction();

            if($request->status === 'cancelled'){
                Product::where('order_id', $order->id)->increment('stock_quantity', $order->total_amount);
            }
            
            $order->update($request->validated());
            if($request->orderItems){
                OrderItem::createMany($request->orderItems);
            }

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            return $e;
        }
        
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try{
            DB::beginTransaction();
            
            $order->delete();
            OrderItem::where('order_id', $order->id)->delete();
            
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            return $e;
        }
        

        return $order;
    }
}
