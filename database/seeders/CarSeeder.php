<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Toyota Carola',
                'day_rate' => 100,
                'monthly_rate' => 1000,
            ],
            [
                'name' => 'Toyota Camry',
                'day_rate' => 100,
                'monthly_rate' => 1000,
            ],
            [
                'name' => 'Toyota Fortuner',
                'day_rate' => 100,
                'monthly_rate' => 1000,
            ],
            [
                'name' => 'Toyota Hilux',
                'day_rate' => 100,
                'monthly_rate' => 1000,
            ],
            [
                'name' => 'Toyota Land Cruiser',
                'day_rate' => 100,
                'monthly_rate' => 1000,
            ],

        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
