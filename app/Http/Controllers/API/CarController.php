<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('orders')->get();
        return response()->json([
            'success' => true,
            'message' => 'Cars fetched successfully',
            'data' => $cars
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'day_rate' => 'required',
            'monthly_rate' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car = Car::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Car created successfully',
            'data' => $car
        ], 201);
    }

    public function show($id)
    {
        $car = Car::with('orders')->find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }
        return response()->json($car);
    }

    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required',
            'day_rate' => 'required',
            'monthly_rate' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
            Storage::delete('public/'.$car->image);
        }

        $car->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Car updated successfully',
            'data' => $car
        ], 200);
    }

    public function destroy($id)
    {
        $car = Car::with('orders')->find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }
        $car->delete();
        return response()->json([
            'success' => true,
            'message' => 'Car deleted successfully'
        ], 200);
    }
}
