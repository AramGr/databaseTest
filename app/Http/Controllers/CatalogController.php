<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cproduct;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function create()
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

    public function show()
    {
        $products = DB::table('cproducts')
                        ->select('cproducts.id', DB::raw('sum(offers.sales) AS sum'))
                        ->leftJoin('offers', 'offers.product_id', '=', 'cproducts.id')
                        ->groupBy('offers.product_id')
                        ->orderBy('sum', 'desc')
                        ->limit(20)
                        ->get()
                        ->toArray();

        $products_id = [];
        foreach ($products as $product){
            $products_id[] = $product->id;
        }

        $products = Cproduct::whereIn('id', $products_id)->get()->load('categories');

        return view('catalog.home', ['products' => $products]);
    }

    public function categoryShow($name)
    {
        $products = DB::table('cproducts')
                        ->select('cproducts.id', 'cproducts.title', 'image', 'price')
                        ->leftJoin('categories', 'categories.product_id', '=', 'cproducts.id')
                        ->where('alias', $name)
                        ->get();

        return view('catalog.category', ['name' => $name, 'products' => $products]);
    }

    public function searchShow(Request $request)
    {
        $products = Cproduct::where('title', 'like', '%' . $request->search . '%')
                            ->orWhere('description', 'like', '%' . $request->search . '%')
                            ->get();
        $products->load('categories');

        return view('catalog.search', ['title' => $request->search, 'products' => $products]);
    }
}


