<?php

namespace App;

use App\Category;
use App\Seller;
use App\Transaction;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $hidden = ['pivot'];
    
    public $transformer = ProductTransformer::class;
	
	const AVALABLE_PRODUCT = "available";
	const UNAVALABLE_PRODUCT = "unavailable";

    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id'
    ];

    public function isAvailable(){
    	return $this->status == Product::AVALABLE_PRODUCT;
    }

    public function categories(){
    	return $this->belongsToMany(Category::class);
    }

    public function seller(){
    	return $this->belongsTo(Seller::class);
    }

    public function transactions(){
    	return $this->hasMany(Transaction::class);
    }
}
