<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Http::get('https://www.gyapu.com/api/menu/detailforuser/categories')['data']['child'][0]['child_menu']; 
       function recursive($res,$cat=NULL){
            collect($res)->each(function($item, $key)use($cat) {
                $category= $cat;
                if(is_null($cat)){
                    $category=Category::create([
                        'title' => $item['title'],
                        'slug' => Str::slug($item['title'], '-')
                    ]);
                }
                else{
                    // $cats=Category::where('name',$item['title'])->first();
                    // if(is_null($cats)){
                        $category=$category->subcategory()->create([
                            'title' => $item['title'],
                            'slug' => Str::slug($item['title'], '-')
                        ]);
                    // }
                    // else{
                    //     $category->subcategory()->save($cats);
                    //     $category=$cats;
                    // }
                }


                if(array_key_exists('image',$item)){
                    echo $item['image']['path']."<br>";
                    $category->image()->create([
                        'alt' => $item['title'],
                        'url' => 'https://www.gyapu.com/'.$item['image']['path']
                    ]);
                }
                echo $item['title']."<br><br>";
                echo count($item['child_menu'])."<br><br>";

                if(count($item['child_menu'])>0){
                    recursive($item['child_menu'],$category);
                }
            });
        }
        recursive($categories); 
        $categories=Category::with(['image','subcategory','subcategory.subcategory','subcategory.products','subcategory.products.images','products','products.images'])->where('parent_id',NULL)->get(); 
    dd($categories);          
    return $categories;                                                                                                                            
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
