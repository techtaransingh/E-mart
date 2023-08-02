<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(Request $request)
    {

        $type = Auth::user()->usertype;

        $total_customers = Order::distinct('user_id')->count();


        if ($type != 0) {
            $orders_data = Order::all();
            $total_quantity = 0;
            $total_revenue = 0;
            foreach ($orders_data as $value) {
                $total_quantity = $total_quantity + $value->quantity;
                $total_orders = count($orders_data);
                $total_revenue = $total_revenue + ($value->quantity * $value->price);
                $order_delivered = Order::where(['delivery_status' => 'delivered'])->count();
                $order_processed = Order::where(['payment_status' => 'processing'])->count();

            }
            // echo $order_processed;
            // die;
            return view('admin.home', [
                'total_quantity' => $total_quantity,
                'total_orders' => $total_orders,
                'total_customers' => $total_customers,
                'total_revenue' => $total_revenue,
                'order_delivered' => $order_delivered,
                'order_processed' => $order_processed,

            ]);
        } else {
            return redirect('/');
            // $products = Product::paginate(3);
            // $comments = Comment::all();
            // return view('home.userpage', ['products' => $products, 'comments' => $comments]);
        }
    }
    public function index(Request $request)
    {

        $products = Product::paginate(3);
        $comments = Comment::all();



        return view('home.userpage', [
            'products' => $products,
            'comments' => $comments,

        ]);
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
        $product_ids = [];
        $cart = Carts::where('user_id', $user->id)->get();
        foreach ($cart as $value) {
            $product_ids[] = $value->product_id;

        }
        //relation through agr krna
        // $cart2 = Carts::with('getProducts')->where('user_id', $user->id)->get();
        $product[] = Product::whereIn('id', $product_ids)->get();

        // print_r($product->price);
        // die;
        // dd($cart);
        return view('home.cart', ['cart' => $cart, 'product' => $product]);
    }
    public function delete_product(Request $request, $id)
    {

        $delete_cart_product = Carts::find($id);
        $delete_cart_product->delete();
        return back();
    }
    public function cash_order(Request $request)
    {
        $user = auth::id();
        $cart = Carts::where('user_id', $user)->get();
        foreach ($cart as $value) {

            $data[$value->product_id] = [
                'name' => $value->name,
                'email' => $value->email,
                'phone' => $value->phone,
                'address' => $value->address,
                'product_title' => $value->product_title,
                'price' => $value->price,
                'quantity' => $value->quantity,
                'image' => $value->image,
                'user_id' => $value->user_id,
                'product_id' => $value->product_id,
                'payment_status' => 'processing',
                'delivery_status' => 'cash on delivery',
            ];
            $stock_update = Product::find($value->product_id);
            $stock_update->update(['quantity' => ($stock_update->quantity - $value->quantity)]);

            $orders = Order::create($data[$value->product_id]);
            $cart_cleared = Carts::where('product_id', $value->product_id)
                ->where('user_id', $user)->delete();
        }
        return redirect('/')->with('message', 'Cash on delivery order placed successfully');
    }

    public function show_order(Request $request)
    {
        $user_id = auth::id();
        $orders = Order::where('user_id', $user_id)->paginate(3);
        return view('home.show_orders', ['orders' => $orders]);
    }
    public function cancel_order(Request $request, $id)
    {
        $order = Order::find($id)->update([
            'delivery_status' => 'Cancelled',
            'payment_status' => 'Cancelled'
        ]);

        return back()->with('message', 'Order Cancelled');
    }
    public function add_comment(Request $request)
    {
        $user_id = auth::id();
        $user_name = auth::user()->name;
        $comment_data = Comment::create([
            'user_id' => $user_id,
            'comment' => $request->comment,
            'name' => $user_name
        ]);
        return back()->with('message', 'Comment Posted');
    }
    public function add_reply(Request $request, $id)
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;

        $replies = Reply::Create([
            'name' => $user_name,
            'comment_id' => $id,
            'reply' => $request->reply,
            'user_id' => $user_id,
        ]);

        // $replies = new Reply;
        // $replies->name = $user_name;
        // $replies->comment_id = $id;
        // $replies->reply = $request->reply;
        // $replies->user_id = $user_id;
        // $replies->save();

        return back();
    }
}