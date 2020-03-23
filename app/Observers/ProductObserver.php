<?php

namespace App\Observers;

use App\Product;

class ProductObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    public function updated(Product $product)
    {
        if($product->quantity == 0  && $product->isAvailable()){
            $product->status = Product::UNAVALABLE_PRODUCT;
            $product->save();
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(Product $product)
    {
        //
    }
}