<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends ApiController
{
    public function index(Product $product){
    	$buyers = $product->transactions()->with('buyer')
    			->get()
    			->pluck('buyer')
    			->unique('id')
    			->values();
    	return $this->showAll($buyers);
    }
}
