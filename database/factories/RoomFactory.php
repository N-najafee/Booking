<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
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
        $rooms = ['Single Room', 'Twin Room', 'Triple Room', 'Suite Room', 'Duplex Room', 'Penthouse Room'];
        $photo = ['photo1.jpg', 'photo2.jpg', 'photo3.jpg', 'photo4.jpg', 'photo5.jpg', 'photo6.jpg'];
        $videoCode = ['yKwIa', 'hrOXM', 'tlOhP', 'lodBh', 'LAi9Y', 'bxOBl'];
        return [
            'name' => $rooms[$index],
            'description' => $this->faker->text(4000),
            'price' => $this->faker->randomElement([100000, 200000, 300000]),
            'total_rooms' => $this->faker->numberBetween(1, 3),
            'size' => $this->faker->randomElement([12, 30, 18, 24]),
            'total_beds' => $this->faker->numberBetween(1, 3),
            'total_guests' => $this->faker->numberBetween(1, 3),
            'total_bathroom' => $this->faker->numberBetween(1, 2),
            'total_balconies' => $this->faker->numberBetween(1, 2),
            'main_photo' => $photo[$index],
            'video_code' => $videoCode[$index],
        ];
    }
}
