<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review; // Import the Review model

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'content' => 'Test review',
            'rating' => 5,
            'user_id' => 1, 
            'decor_id' => 1, 
        ]);
    }
}
