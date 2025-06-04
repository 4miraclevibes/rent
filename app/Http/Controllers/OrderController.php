<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Car;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $cars = Car::all();
        return view('pages.backend.orders.index', compact('orders', 'cars'));
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

        $car = Car::find($request->car_id)->with('orders')->first();
        $orders = Order::where('car_id', $car->id)->whereBetween('pickup_date', [$request->pickup_date, $request->dropoff_date])->get();
        if($orders->count() > 0){
            return redirect()->route('orders.index')->with('error', 'Car is already rented');
        }

        $data = $request->all();
        Order::create($data);
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    public function update(Request $request, $id)
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
        if($data['order_date'] < $data['pickup_date']){
            return redirect()->route('orders.index')->with('error', 'Order date must be before pickup date');
        }
        if($data['pickup_date'] < $data['dropoff_date']){
            return redirect()->route('orders.index')->with('error', 'Pickup date must be before dropoff date');
        }
        Order::find($id)->update($data);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}