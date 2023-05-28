<?php

namespace Database\Factories;

use App\Http\constants\Constants;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_number' => Str::uuid(),
            'transaction_no' => Str::uuid(),
            'payment_type' => Constants::ZARINPAL,
            'paid_amount' => $this->faker->randomElement([500000, 1000000, 1500000, 200000]),
            'booking_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => Constants::ORDER_SUCCESSFUL
        ];
    }
}
