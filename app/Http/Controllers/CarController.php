<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('pages.backend.cars.index', compact('cars'));
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
        $data['image'] = $request->file('image')->store('cars', 'public');
        Car::create($data);
        return redirect()->route('cars.index')->with('success', 'Car created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'day_rate' => 'required',
            'monthly_rate' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $car = Car::find($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
            Storage::delete('public/'.$car->image);
        }
        $car->update($data);
        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }

    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        Storage::delete('public/'.$car->image);
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }
}