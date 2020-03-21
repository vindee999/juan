<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $userQuantity = 1000;
        $CategoriesQuantity = 30;
        $productsQuantity = 1000;
        $transactionQuantity = 1000;

        factory(User::class,$userQuantity)->create();
        factory(Category::class,$CategoriesQuantity)->create();
        factory(Product::class,$productsQuantity)->create()->each(
        	function($product){
        		$categories = Category::all()->random(mt_rand(1,5))->pluck('id');
        		$product->categories()->attach($categories);
        	}
        );
        factory(Transaction::class,$transactionQuantity)->create();


    }
}
