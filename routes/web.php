<?php

use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SecurePayController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('home.userpage');
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add/category', [AdminController::class, 'add_category']);
Route::get('/category_delete/{id}', [AdminController::class, 'category_delete']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/view_productlist', [AdminController::class, 'view_productlist']);
Route::get('/productlist_delete/{id}', [AdminController::class, 'productlist_delete']);
Route::get('/productlist_edit/{id}', [AdminController::class, 'productlist_edit']);
Route::get('/view_orderlist', [AdminController::class, 'view_orderlist']);
Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

Route::post('/search_order', [AdminController::class, 'search_order']);
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart/{id?}', [HomeController::class, 'show_cart']);
Route::get('/delete_product/{id}', [HomeController::class, 'delete_product']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::get('/show_order', [HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);
Route::post('/add_comment', [HomeController::class, 'add_comment']);
Route::post('/add_reply/{id}', [HomeController::class, 'add_reply']);
Route::get('/stripe/{price}', [StripeController::class, 'stripe']);
Route::post('/stripePost', [StripeController::class, 'stripePost']);
// Route::get('stripe-form/{price}', [StripePaymentController::class, 'form'])->name('stripeForm');
// Route::post('stripe-form/submit', [StripePaymentController::class, 'submit'])->name('stripeSubmit');
// Route::get('stripe-response/{id}', [StripePaymentController::class, 'response'])->name('stripeResponse');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});