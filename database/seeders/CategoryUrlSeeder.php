<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class CategoryUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = Http::get('https://www.gyapu.com/api/menu/detailforuser/categories')['data']['child'][0]['child_menu']; 
       function recursive($res){
            collect($res)->each(function($item, $key){
                $category;
                $category=firstOrCreate([
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title'], '-')
                ]);
                $cats=Category::where('slug',Str::slug($item['title'], '-'));
                if($cats==null){
                    $category=Category::create([
                        'title' => $item['title'],
                        'slug' => Str::slug($item['title'], '-')
                    ]);
                    if(array_key_exists('image',$item)){
                        $category->image()->create([
                            'alt' => $item['title'],
                            'url' => 'https://www.gyapu.com/'.$item['image']['path']
                        ]);
                    }
                    
                }
                else{
                    $category=$cats->subcategory()->create([
                        'title' => $item['title'],
                        'slug' => Str::slug($item['title'], '-')
                    ]);
                    if(array_key_exists('image',$item)){
                        $category->image()->create([
                            'alt' => $item['title'],
                            'url' => 'https://www.gyapu.com/'.$item['image']['path']
                        ]);
                    }
                }
                if(count($item['child_menu'])>0){
                    recursive($item['child_menu']);
                }
            });
        }
        recursive($categories); 
    }
}
