<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $allProducts=[];
        $products = Http::get('https://www.gyapu.com/api/productgroup/userproductgroup')['data']; 

        foreach($products as $productgroup){
            foreach($productgroup['product'] as $p){
                $product=[];
                $images=[];
                $product['name']=$p['name'];
                $product['sku']=$p['sku_from_system'];
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
                    $category=\App\Models\Category::where("title",$p['category']['title'])->first();
                    $product['category_id']= $category != null?$category->id:null;
                }
                $product['image']=$images;
                $pdt=Product::create($product);
                $pdt->images()->createMany($images);
                array_push($allProducts,$product);
                // echo $product['name'];
            }
        }
        return $allProducts;

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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
