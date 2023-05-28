<?php

use App\Http\Controllers\admin\AmenityController;
use App\Http\Controllers\admin\FeatureController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\RoomPhotoController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/tt',[HotelController::class,'factory']);

// login with google account
Route::controller(LoginController::class)->group(function (){
    Route::get("login/google",  "redirectToProvider")->name('login.google');
    Route::get("login/google/callback",  "handleProvider");
});

Route::prefix('hotel')->controller(HotelController::class)->group(function (){
    Route::get('/',  'index')->name('hotel');
    Route::get('/load-more',  'load_more');
    Route::get('/blog-list',  'blog_list')->name('blog.list');
    Route::get('/blog/{post}',  'blog_show')->name('blog.show')->middleware('throttle:2,1');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/room-list/',  'room_list')->name('room.list');
    Route::get('/room-detail/{id}',  'room_detail')->name('room.detail');
});


Route::middleware('auth')->group(function (){
    Route::post("/paymentCreate", [PaymentController::class, 'payment_store'])->name('paymentCreate.store');
    Route::get("/paymentCreate-verify/{totalAmount}", [PaymentController::class, 'payment_verify'])->name('paymentCreate.verify');
    Route::get('booking-checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::resource('booking', BookingController::class);
    Route::resource('profile', ProfileController::class)->parameters(['profile' => 'user']);
    Route::resource('comment', CommentController::class)->only('store');

});

Route::prefix('admin/')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('feature', FeatureController::class)->except('show');
    Route::resource('video', VideoController::class)->except('show');
    Route::resource('amenity', AmenityController::class)->except('show');
    Route::resource('order', OrderController::class)->only(['show', 'index']);
    Route::resource('post', PostController::class);
    Route::resource('room', RoomController::class);
    Route::resource('user', UserController::class);
    Route::resource('comment', CommentController::class)->only(['index', 'update', 'destroy']);
    Route::resource('room-photo', RoomPhotoController::class)->parameters(['room-photo' => 'room'])->except(['index', 'create']);
});


