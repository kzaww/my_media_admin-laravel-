<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\trendPostController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    //direct profile page
    route::get('profile',[adminController::class,'dashboard'])->name('admin#dashboard');
    //404 page for user
    route::get('notFound',[adminController::class,'notfound'])->name('admin#notfound');

    route::middleware('adminCheck')->group(function(){
        //change profile
        route::post('change',[adminController::class,'changeprofile'])->name('admin#changeProfile');
        //change password
        route::post('changePassword',[adminController::class,'changepassword'])->name('admin#changePassword');

        route::prefix('category')->group(function(){
            //direct category list page
            route::get('list',[categoryController::class,'categoryList'])->name('admin#categoryList');
            //create category list
            route::post('create',[categoryController::class,'categoryCreate'])->name("admin#categoryCreate");
            route::post('delete',[categoryController::class,'categoryDelete'])->name('admin#categoryDelete');
            route::get('edit/{id}',[categoryController::class,'categoryEdit'])->name('admin#categoryEdit');
            route::post('update',[categoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');
        });

        route::prefix('post')->group(function(){
            //direct product list
            route::get('list',[postController::class,'postList'])->name('admin#postList');
            route::post('create',[postController::class,'postCreate'])->name('admin#postCreate');
            route::post('delete',[postController::class,'postDelete'])->name('admin#postDelete');
            route::get('edit/{id}',[postController::class,'postEdit'])->name('admin#postEdit');
            route::post('update',[postController::class,'postUpdate'])->name('admin#postUpdate');
            route::get('detail/{id}',[postController::class,'postDetails'])->name("admin#postDetail");

        });
        //trend Post
        route::get('trendPost',[trendPostController::class,'trendPost'])->name('admin#trendPost');
    });
});
