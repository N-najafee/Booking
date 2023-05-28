<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Feature::factory()->count(6)->create();
        Post::factory()->count(12)->create();
        Video::factory()->count(12)->create();
        User::factory()->count(12)->create();
        $this->call(InsertDataSeeder::class);
    }
}
