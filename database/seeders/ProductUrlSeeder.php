<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $allProducts=[];
        $allProductGroups=[];
        $cats=\App\Models\Category::all()->pluck('slug')->take(10);
        foreach($cats as $cat){
            $products = Http::get('https://www.gyapu.com/api/product/productbycategory/'.$cat); 
            array_push($allProductGroups,$products['data']??null);
        }
        $allProductGroups=array_filter($allProductGroups);
        foreach($allProductGroups as $productgroup){
            foreach($productgroup as $p){
                $product=[];
                $images=[];
                $product['name']=$p['name'];
                $product['sku']=$p['sku_from_system']??$p['sku_of_seller'];
                $product['slug']=Str::slug($p['name']);
                $product['price']=$p['max_sales_price'];
                $product['description']=$p['description'];
                if($p['image']){
                    foreach($p['image'] as $img){
                        $image=[];
                        $image['url']='https://www.gyapu.com/'.$img['document']['path'];
                        $image['alt']=$p['name'];
                        array_push($images,$image);
                    }
                }
                //for variant ->future purpose
                // if($p['variant']){
                // }   
                
                //for category
                if($p['category']){
                    $category=\App\Models\Category::where("slug",Str::slug($p['category']['title']))->first();
                    $product['category_id']= $category != null?$category->id:4;
                }
                $pdt=\App\Models\Product::create($product);
                $pdt->images()->createMany($images);
               
                $product['image']=$images;
                // array_push($allProducts,$product);
            }
        }
    }
}
