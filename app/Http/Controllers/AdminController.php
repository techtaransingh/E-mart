<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $category_list = Category::simplePaginate(2)->sortByDesc('id');
        // print_r($category_list);

        return view('admin.category', ['category_list' => $category_list]);
    }
    public function add_category(Request $request)
    {
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
}