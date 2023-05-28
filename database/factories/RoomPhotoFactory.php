<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomPhoto>
 */
class RoomPhotoFactory extends Factory
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
        $photos=[
            'subphoto1-1.jpg','subphoto1-2.jpg',
            'subphoto2-1.jpg','subphoto2-2.jpg',
            'subphoto3-1.jpg','subphoto3-2.jpg',
            'subphoto4-1.jpg','subphoto4-2.jpg',
            'subphoto5-1.jpg','subphoto5-2.jpg',
            'subphoto6-1.jpg','subphoto6-2.jpg'
        ];
        return [
            'photo'=>$photos[$index],
            'room_id'=>Room::factory(),
        ];
    }
}
