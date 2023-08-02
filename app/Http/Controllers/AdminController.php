<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $category_list = Category::orderby('id', 'desc')->paginate();
        // print_r($category_list);

        return view('admin.category', ['category_list' => $category_list]);
    }
    public function add_category(Request $request)
    {
        $request->validate(['category_name' => 'required']);
        // print_r($request->category_name);die;
        $category = Category::create($_REQUEST);
        return back()->with('success', 'Category added successfully!');

    }
    public function category_delete(Request $request, $id)
    {

        $category_id = Category::find($id);
        $category_deleted = $category_id->delete();

        return back()->with('success', 'entry deleted successfully!');

    }
    public function view_product(Request $request)
    {
        $category = Category::all();

        return view('admin.product', ['category' => $category]);
    }
    public function add_product(Request $request)
    {

        // $request->validate([]);
        $image = time() . '.' . $request->file('image')->extension();
        // dd($image);
        $request->file('image')->move(public_path('images'), $image);
        $product = Product::create($_REQUEST);
        if ($product) {
            $product->image = $image;
            $product->save();

        }
        return back()->with('success', 'Product added successfully!');

    }
    public function view_productlist(Request $request)
    {
        // echo $id;
        // die;
        $products = Product::all();
        $category = Category::all();
        // dd($products);

        return view('admin.productlist', ['products' => $products, 'category' => $category]);
    }
    public function productlist_delete(Request $request, $id)
    {
        // echo $id;
        // die;
        $product_id = Product::find($id);
        $product_deleted = $product_id->delete();

        return back()->with('success', 'entry deleted successfully!');
    }
    public function productlist_edit(Request $request, $id)
    {
        // echo $id;
        // die;
        $product = Product::find($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $image);
            $data['image'] = $image;
        }

        Product::where('id', $id)->update($data);

        return view('admin.productlist', ['product' => $product,]);
    }

    public function view_orderlist(Request $request)
    {
        $order = Order::all();
        return view('admin.orderlist', ['order' => $order]);
    }
    public function delivered(Request $request, $id)
    {
        $order_delivered = Order::find($id);
        // dd($order_delivered->payment_status);
        if ($order_delivered->payment_status == 'Paid by card') {
            $order_delivered->update(['delivery_status' => 'delivered']);
        } else {
            $order_delivered->update(['payment_status' => 'Paid by cash', 'delivery_status' => 'delivered']);
        }
        return back()->with('message', 'Order No ' . $id . ' Delivered Successfully');
    }
    public function print_pdf(Request $request, $id)
    {
        // echo public_path('images');
        // die;
        $data = Order::find($id);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => false, 'chroot' => public_path('images')])->loadView('admin.order_detail', ['data' => $data]);

        // dd($data->image);
        echo 'Current PHP version: ' . phpversion();
        die;
        // return view('admin.order_detail', ['data' => $data]);
        // return $pdf->download('order_detail' . $id . '.pdf');
        return $pdf->download('order_detail.pdf');
    }
    public function search_order(Request $request)
    {
        // dd($request->search);
        $search = $request->search;
        $order = Order::where('name', 'like', '%' . $search . '%')
            ->orwhere('phone', 'like', '%' . $search . '%')
            ->orwhere('address', 'like', '%' . $search . '%')->get();

        // dd($order);
        return view('admin.orderlist', ['order' => $order]);
    }
}