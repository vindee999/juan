<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;

class SellerTransactionController extends ApiController
{
    public function index(Seller $seller)
    {
        $transactions = $seller->products()
        			->whereHas('transactions')
        			->with('transactions')
        			->get()
        			->pluck('transactions')
        			->collapse()
        			->unique('id')
        			->values();

        return $this->showAll($transactions);
    }
}
