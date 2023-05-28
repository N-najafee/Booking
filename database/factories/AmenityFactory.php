<?php

namespace Database\Factories;

use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $num = 0;
        $index = $num++;
        $amenities = [
            'Toiletries (Shampoo, lotion)',
            'Hair Dryer',
            'Towels',
            'Coffee Kit',
            'Free breakfast',
            'Premium coffee',
            'Gym or fitness center',
            'Room Purification',
            'Relaxation Devices',
            'Kid Equipment',
            'Swimming pool',
            'Desks in rooms',
        ];
        return [
            'name' => $amenities[$index],
        ];
    }
}
