<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('buyers','Buyer\BuyerController',['only' => ['index','show'] ]);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController',['only' => ['index'] ]);
Route::resource('buyers.products','Buyer\BuyerProductController',['only' => ['index'] ]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController',['only' => ['index'] ]);
Route::resource('buyers.categories','Buyer\BuyerCategoryController',['only' => ['index'] ]);


Route::resource('categories','Category\CategoryController',['except' => ['create','edit'] ]);
Route::resource('categories.products','Category\CategoryProductController',['only' => ['index'] ]);
Route::resource('categories.sellers','Category\CategorySellerController',['only' => ['index'] ]);
Route::resource('categories.transactions','Category\CategoryTransactionController',['only' => ['index'] ]);
Route::resource('categories.buyers','Category\CategoryBuyerController',['only' => ['index'] ]);


Route::resource('products','Product\ProductController',['only' => ['index','show'] ]);

Route::resource('sellers','Seller\SellerController',['only' => ['index','show'] ]);
Route::resource('sellers.transactions','Seller\SellerTransactionController',['only' => ['index'] ]);
Route::resource('sellers.categories','Seller\SellerCategoryController',['only' => ['index'] ]);
Route::resource('sellers.buyers','Seller\SellerBuyerController',['only' => ['index'] ]);
Route::resource('sellers.products','Seller\SellerProductController',['only' => ['index','store'] ]);


Route::resource('transactions','Transaction\TransactionController',['only' => ['index','show'] ]);
Route::resource('transactions.categories','Transaction\TransactionCategoryController',['only' => ['index'] ]);
Route::resource('transactions.sellers','Transaction\TransactionSellerController',['only' => ['index'] ]);


Route::resource('users','User\UserController',['except' => ['create','edit'] ]);