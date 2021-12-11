<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChangePass;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'images'));
});

Route::get('/home', function () {
    echo "This is Home Page";
});

Route::get('/about',[AboutController::class,'index']);

Route::get('/contact',[ContactController::class,'index']);

///Category Route
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::POST('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::POST('/brand/update/{id}',[CategoryController::class,'Update']);
Route::get('/softdelete/category/{id}',[CategoryController::class,'SoftDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);
Route::get('/pdelete/category/{id}',[CategoryController::class,'Pdelete']);

///Brand Route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::POST('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::POST('/brand/update/{id}',[BrandController::class,'Update']);
Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);


////Multi Image Route
Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.image');
Route::POST('/multi/add',[BrandController::class,'StoreImg'])->name('store.image');


///Admin all route
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add.slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store.slider',[HomeController::class,'StoreSlider'])->name('store.slider');

///Home About All Route
Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/about',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('/store/about',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('about/edit/{id}',[AboutController::class,'EditAbout']);
Route::post('update/homeabout/{id}',[AboutController::class,'UpdateAbout']);
Route::get('/about/delete/{id}',[AboutController::class,'DeleteAbout']);

///Portfolio Route
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');


////Admin Contact page Route
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact',[ContactController::class,'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');
Route::get('/message/delete/{id}',[ContactController::class,'MessageDelete']);

////Home Contact page Route
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');






Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');


////////Change password and user Profile Route
Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');
Route::post('/password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');