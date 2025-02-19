<?php
namespace Database\Factories;

use App\Models\Decor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DecorFactory extends Factory
{
    protected $model = Decor::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(100, 1000),
            'image' => 'decors/' . $this->faker->image('public/storage/decors', 640, 480, null, false),
        ];
    }
}
