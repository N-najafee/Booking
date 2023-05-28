<?php

namespace Database\Factories;

use App\Http\constants\Constants;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'room_id'=>Room::factory(),
            'user_id'=>User::factory(),
            'comment'=>$this->faker->text(200),
            'status'=>Constants::COMMENT_UNVERIFIED,
        ];
    }
}
