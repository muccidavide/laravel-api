<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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


Route::post('contact-form', function (Request $request)
{
    ddd($request->all());
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('posts', 'PostController')->parameters([
            'posts'=> 'post:slug'
        ]);

        Route::resource('categories', 'CategoryController')->parameters([
            'categories' => 'category:slug'
        ])->except(['show','create', 'edit']); // esclude rotta show

        Route::resource('tags', 'TagController')->parameters([
            'tags' => 'tag:slug'
        ])->except(['show','create', 'edit']); 
    }
);

Route::get("{any?}", function(){
    return view("guest.home");
})->where("any", ".*"); 