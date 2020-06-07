<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        return Order::with('customer')->get()->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $customer = Customer::findOrFail($request->customer_id);
        $order = Order::firstOrNew($request->only(
            'type',
            'status',
            'trackingNumber',
            'orderDate',
            'totalPrice'
        ));

        $order->customer()->associate($customer);
        $order->save();
        return $order;
    }

    public function addItem(Order $order, Item $item, $quantity)
    {   
        $order->items()->attach($item, ['quantity' => $quantity]);
        $order->load('items');

        return $order;
    }

    public function removeItem(Order $order, Item $item)
    {
        $order->items()->detach($item);
        $order->load('items');

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
         return Order::with('customer')->findOrFail($order->id)->toJson(JSON_PRETTY_PRINT);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        $customer = Customer::findOrFail($request->customer_id);
        $order->customer()->associate($customer);
        $order->save();
        $order->load('customer');
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return 'deleted.';
    }
}
