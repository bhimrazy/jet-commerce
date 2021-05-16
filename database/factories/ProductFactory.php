<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $title=$this->faker->text(rand(35,45));
        return [
            'name' => $title,
            'price'=>rand(5000,15000),
            'slug' => Str::slug($title, '-'),
            'sku'=> Str::random(8),
            'description' => $this->faker->paragraph,
            'category_id'=>\App\Models\Category::all()->random()->id
        ];
    }
}
