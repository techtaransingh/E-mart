<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(Request $request)
    {

        $type = Auth::user()->usertype;
        // echo 'hellooooo';die;
        if ($type != 0) {
            return view('admin.home');
        } else {
            $products = Product::paginate(3);
            return view('home.userpage', ['products' => $products]);
        }
    }
    public function index(Request $request)
    {
        $products = Product::paginate(3);


        return view('home.userpage', ['products' => $products]);
    }
    public function product_details(Request $request, $id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category);

        return view('home.product_details', ['product' => $product, 'category' => $category]);
    }
}