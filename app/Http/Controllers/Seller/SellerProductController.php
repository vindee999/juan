<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->showAll($products);
    }

    public function store(Request $request,Seller $seller)
    {
    	$rules = [
    		'name' => 'required',
    		'description' => 'required',
    		'quantity' => 'required|integer|min:1',
    		'image' => 'required|image'
    	];

    	$this->validate($request,$rules);
    	$data = $request->all();

    	$data['status'] = Product::UNAVALABLE_PRODUCT;
    	$data['image'] = 'elephant.jpg';
    	$data['seller_id'] = $seller->id;

    	$product = Product::create($data);

        return $this->showOne($product);
    }
}
