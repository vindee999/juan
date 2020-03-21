<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends ApiController
{
    public function index(Transaction $transaction)
    {
        $sellers = $transaction->product->seller;
        return $this->showOne($sellers);
    }
}
