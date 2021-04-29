<?php

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

Route::get('/','WelcomeController@index')->name('welcome.show');
Route::get('/posts/{post}',[\App\Http\Controllers\Blog\PostsController::class,'show'])->name('blog.show');
Route::get('blog/categories/{category}',[\App\Http\Controllers\Blog\PostsController::class,'category'])->name('blog.category');
Route::get('blog/tags/{tag}',[\App\Http\Controllers\Blog\PostsController::class,'tag'])->name('blog.tag');


Auth::routes();


Route::middleware(['auth'])->group(function(){
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories','CategoriesController');
Route::resource('post','PostController');
Route::resource('tags','TagsController');
Route::get('trashed-post','PostController@trashed')->name('trashed_post.index');
Route::put('restore-post/{post}','PostController@restore')->name('restore.posts');

});
Route::middleware(['auth','admin'])->group(function(){
    Route::get('users/profile','usersController@edit')->name('users.edit-profile');
    Route::put('users/profile','UsersController@update')->name('users.update-profile');
    Route::get('users','UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin','UsersController@makeAdmin')->name('users.make-admin');
});

