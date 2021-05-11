<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'url'=>'https://www.gyapu.com/public/files/685788916D66EB8-fruit-and-veg_1050x600.jpg',
            'url'=>$this->faker->imageUrl(),
            'alt'=>$this->faker->title(10)
        ];
    }
}
