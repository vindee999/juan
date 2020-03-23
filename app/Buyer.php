<?php

namespace App;
use App\Scopes\BuyerScope;
use App\Transaction;
use App\Transformers\BuyerTransformer;
use App\User;

class Buyer extends User
{
	public $transformer = BuyerTransformer::class;

	protected static function boot(){
		parent::boot();

		static::addGlobalScope(new BuyerScope);
	}

    public function transactions(){
    	return $this->hasMany(Transaction::class);
    }
}
