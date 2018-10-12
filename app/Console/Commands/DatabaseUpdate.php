<?php

namespace App\Console\Commands;

use App\Category;
use App\Cproduct;
use App\Offer;
use App\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command updates the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://markethot.ru/export/bestsp');
        $response = json_decode($request->getBody());
        $response = (array)$response;

        DB::table('categories')->delete();
        DB::table('offers')->delete();
        DB::table('cproducts')->delete();

        $products = [];
        $offers = [];
        $categories = [];

        foreach ($response["products"] as $product){
            $products[] = [
                'id' => $product->id,
                'title' => $product->title,
                'image' => $product->image,
                'description' => $product->description,
                'first_invoice' => $product->first_invoice,
                'price' => $product->price,
                'amount' => $product->amount,
            ];

            foreach($product->offers as $offer){
                $offers[] = [
                    'id' => $offer->id,
                    'product_id' => $product->id,
                    'price' => $offer->price,
                    'amount' => $offer->amount,
                    'sales' => $offer->sales,
                    'article' => $offer->article,
                ];
            }

            foreach($product->categories as $category){
                $categories[] = [
                    'id' => $category->id,
                    'product_id' => $product->id,
                    'title' => $category->title,
                    'alias' => $category->alias,
                    'parent' => $category->parent,
                ];
            }


        }

        Cproduct::insert($products);
        Offer::insert($offers);
        Category::insert($categories);
    }
}
