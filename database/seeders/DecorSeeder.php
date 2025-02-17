<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Decor;

class DecorSeeder extends Seeder
{
    public function run()
    {
        Decor::insert([
            [
                'name' => 'Hand-Carved Wooden Sofa',
                'description' => 'A stunning hand-carved wooden sofa, combining elegance and comfort. Perfect for creating a warm and natural living space.',
                'price' => 400.00,
                'image' => 'decors/sofa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Solid Wood Dining Table',
                'description' => 'A sturdy solid wood dining table, ideal for family gatherings. Its sleek design blends seamlessly with any interior.',
                'price' => 650.00,
                'image' => 'decors/table.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ergonomic Study Desk',
                'description' => 'A stylish and ergonomic desk designed for a comfortable and productive workspace. Ideal for home offices and study areas.',
                'price' => 1000.00,
                'image' => 'decors/study_table.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
