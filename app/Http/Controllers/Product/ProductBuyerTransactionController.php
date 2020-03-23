<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    public function store(Request $request,Product $product,User $buyer){
    	$rules = [
    		'quantity' => 'required|integer|min:1'
    	];

    	$this->validate($request,$rules);

    	if($buyer->id == $product->seller_id){
            return $this->errorResponse("Buyer must be different",409);
    	}

    	if(!$buyer->isVerified()){
            return $this->errorResponse("Buyer is not verified",409);
    	}

    	if(!$product->seller->isVerified()){
            return $this->errorResponse("Seller is not verified",409);
    	}

    	if(!$product->isAvailable()){
            return $this->errorResponse("Product is not available",409);
    	}

    	if($product->quantity < $request->quantity){
            return $this->errorResponse("Quantity Exceeds",409);
    	}

    	return DB::transaction(function() use ($request,$product,$buyer){
    		$product->quantity -= $request->quantity;
    		$product->save();

    		$transaction = Transaction::create([
    			'quantity' => $request->quantity,
    			'buyer_id' => $buyer->id,
    			'product_id' => $product->id
    		]);

    		return $this->showOne($transaction);
    	});
    }
}
