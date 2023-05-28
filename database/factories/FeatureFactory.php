<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
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
        $icon = [
            'fa-solid fa-coffee',
            'fa fa-bicycle',
            'fa fa-camera',
            'fa fa-television',
            'fa fa-taxi',
            'fa fa-wifi',
            'fa fa-phone',
        ];

        return [
            'title' => $this->faker->text(10),
            'icon' => $icon[$index],
            'description' => 'When my six o’clock alarm buzzes, I require a pot of good java.',
        ];
    }
}
