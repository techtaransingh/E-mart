<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Carts;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        return view('stripe2');
    }

    public function stripePost(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        $customer = Stripe\Customer::create(
            array(

                "address" => [

                    "line1" => "Virani Chowk",

                    "postal_code" => "360001",

                    "city" => "Rajkot",

                    "state" => "GJ",

                    "country" => "IN",

                ],

                "email" => "demo@gmail.com",

                "name" => "Hardik Savani",

                "source" => $request->stripeToken

            )
        );



        $charge = Stripe\Charge::create([

            "amount" => 100 * 100,

            "currency" => "usd",

            "customer" => $customer->id,

            "description" => "Test payment from itsolutionstuff.com.",

            "shipping" => [

                "name" => "Jenny Rosen",

                "address" => [

                    "line1" => "510 Townsend St",

                    "postal_code" => "98140",

                    "city" => "San Francisco",

                    "state" => "CA",

                    "country" => "US",

                ],

            ]

        ]);

        if ($charge) {
            $user_id = auth::id();
            // echo $user_id;
            // $order = Order::where('user_id', $user_id)->first();
            // dd($order);
            // die;
            $cart = Carts::where('user_id', $user_id)->get();
            // dd($cart);
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
                    'user_id' => $user_id,
                    'product_id' => $value->product_id,
                    'payment_status' => 'Paid by card',
                    'delivery_status' => 'Preparing to dispatch',
                ];
                $stock_update = Product::find($value->product_id);
                // print_r('stock_update->quantity' . $stock_update->quantity);
                // echo '<br>';
                // print_r('value->quantity' . $value->quantity);
                // echo '<br>';
                // $stock_left = $stock_update->quantity - $value->quantity;
                // print_r('stock_left' . $stock_left);
                // echo '<br>';
                $stock_update->update(['quantity' => ($stock_update->quantity - $value->quantity)]);

                $orders = Order::create($data[$value->product_id]);
                $cart_cleared = Carts::where('product_id', $value->product_id)
                    ->where('user_id', $user_id)->delete();
            }

            return redirect('/')->with('message', 'Order placed,payment done successfully by card.');

        }
        return back();

    }
}