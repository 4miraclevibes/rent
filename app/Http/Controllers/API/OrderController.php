<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('car')->get();
        return response()->json([
            'success' => true,
            'message' => 'Orders fetched successfully',
            'data' => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'order_date' => 'required',
            'pickup_date' => 'required',
            'dropoff_date' => 'required',
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
        ]);
        $data = $request->all();
        $order = Order::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }

    public function show($id)
    {
        $order = Order::with('car')->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Order found',
            'data' => $order
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $order = Order::with('car')->find($id);
        $order->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => $order
        ], 200);
    }

    public function destroy($id)
    {
        $order = Order::with('car')->find($id);
        $order->delete();
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
