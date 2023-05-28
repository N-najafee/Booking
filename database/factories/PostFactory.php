<?php

namespace Database\Factories;

use App\Http\constants\Constants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
        $imageName = [
            'post1.jpg', 'post2.jpg', 'post3.jpg',
            'post4.jpg', 'post5.jpg', 'post6.jpg',
            'post7.jpg', 'post8.jpg', 'post9.jpg',
            'post10.jpg', 'post11.jpg', 'post12.jpg'
        ];
        return [
            'title' => $this->faker->text(15),
            'photo' => $imageName[$index],
            'short_description' => $this->faker->text(150),
            'description' => $this->faker->text(4000),
            'status' => Constants::POST_ACTIVE,
            'created_at' => $this->faker->dateTimeBetween(now()->subDays(6), now()),
        ];
    }
}
