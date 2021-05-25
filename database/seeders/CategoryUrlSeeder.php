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
       function recursive($res,$cat = null){
            collect($res)->each(function($item, $key)use($cat){
                if($cat == null){
                    $category=Category::create([
                    'name' => $item['title'],
                    'slug' => Str::slug($item['title'], '-')
                    ]);
                    if(array_key_exists('image',$item)){
                        $category->image()->create([
                            'alt' => $item['title'],
                            'url' => 'https://www.gyapu.com/'.$item['image']['path']
                        ]);
                    }
                    if(count($item['child_menu'])>0){
                        recursive($item['child_menu'],$category);
                    }
                }else{
                    $cats=Category::where('slug',Str::slug($item['title'], '-'))->first();
                    if($cats==null && $cat !=null){
                        $category=$cat->subcategory()->create([
                            'name' => $item['title'],
                            'slug' => Str::slug($item['title'], '-')
                        ]);
                        if(array_key_exists('image',$item)){
                            $category->image()->create([
                                'alt' => $item['title'],
                                'url' => 'https://www.gyapu.com/'.$item['image']['path']
                            ]);
                        }
                        if(count($item['child_menu'])>0){
                            recursive($item['child_menu'],$category);
                        }
                        
                    }
                }
            });
        }
        recursive($categories); 
    }
}
