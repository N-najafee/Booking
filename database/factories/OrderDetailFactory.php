<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'room_id' => Room::factory(),
            'checkin_date' => Carbon::tomorrow()->addDays(5)->format('Y/m/d '),
            'checkout_date' => Carbon::tomorrow()->addDays(10)->format('Y/m/d'),
            'adult' => $this->faker->numberBetween(1, 3),
            'children' => $this->faker->numberBetween(1, 2),
            'subtotal' => $this->faker->randomElement([500000, 1000000, 1500000, 200000])
        ];
    }
}
