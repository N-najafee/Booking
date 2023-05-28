<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Comment;
use App\Models\Room;
use App\Models\RoomPhoto;
use Illuminate\Database\Seeder;

class InsertDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = Amenity::factory()->count(12)->create();
        Room::factory()->count(6)->create()->each(function ($room) use ($amenities) {
            $room->amenities()->attach($amenities->random(4));
            RoomPhoto::factory()->count(2)->create(['room_id' => $room->id]);
            Comment::factory()->count(4)->create(['room_id' => $room->id]);
        });

    }
}
