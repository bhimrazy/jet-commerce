<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
        ->count(20)
        ->hasImage()
        ->has(Category::factory()->hasImage()->count(rand(0,10)), 'subcategory')
        ->create();
    }
}
