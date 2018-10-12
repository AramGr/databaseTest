<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show()
    {
        $orders1 = Order::withCount('products')->get();
        $orders2 = Order::has('products', '>' , 10)->with('products')->get();

        $data['orders1'] = $orders1;
        $data['orders2'] = $orders2;



        return view('index', $data);
    }
}
