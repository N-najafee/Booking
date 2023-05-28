<?php

namespace Database\Factories;

use App\Http\constants\Constants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
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
        $vidoCode=[
            'yKwIa', 'hrOXM', 'tlOhP', 'lodBh', 'LAi9Y', 'bxOBl', 'wgUl5', 'P9Fru', 'RnWjL', 'Z5h61', '2idcf', 'Fd9UC',
        ];
        return [
            'video_code'=>$vidoCode[$index],
            'description'=>$this->faker->text(100),
            'status'=>Constants::VIDEO_ACTIVE,
        ];

    }
}
