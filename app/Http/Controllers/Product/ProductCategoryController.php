<?php

namespace App\Http\Controllers\Product;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->showAll($categories);
    }


    public function update(Request $request, Product $product,Category $category)
    {
        //attach , sync , syncWithoutDetaching
        $product->categories()->syncWithoutDetaching($category->id);
        return $this->showAll($product->categories); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Category $category)
    {
        if(!$product->categories()->find($category->id)){
            return $this->errorResponse("Category doews not exist for this product",404);
        }

        $product->categories()->detach($category->id);
        return $this->showAll($product->categories); 
    }
}
