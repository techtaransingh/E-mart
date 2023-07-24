<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Carts;
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
        $category = $product->getCategory;


        return view('home.product_details', ['product' => $product, 'category' => $category]);
    }
    public function add_cart(Request $request, $id)
    {
        $logged_in = auth::id();

        if ($logged_in) {
            $user = auth::user();
            $product = Product::find($id);
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'product_title' => $product->title,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image,
                'product_id' => $request->id,
                'user_id' => $user->id,
            ];
            if ($product->discount_price != null) {
                $data['price'] = $product->discount_price;
            } else {
                $data['price'] = $product->price;
            }
            $cart = Carts::create($data);
            return back();
        } else {
            return redirect('/');
        }
    }
    public function show_cart(Request $request)
    {

        $logged_in = auth::id();

        $user = auth::user();

        $cart = Carts::where('user_id', $user->id)->get();
        foreach ($cart as $value) {
            $product_ids[] = $value->product_id;

        }
        //relation through agr krna
        // $cart2 = Carts::with('getProducts')->where('user_id', $user->id)->get();
        $product[] = Product::whereIn('id', $product_ids)->get();

        // print_r($product->price);
        // die;

        return view('home.cart', ['cart' => $cart, 'product' => $product]);
    }
    public function delete_product(Request $request, $id)
    {

        $delete_cart_product = Carts::find($id);
        $delete_cart_product->delete();
        return back();
    }
}