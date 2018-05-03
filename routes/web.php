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

Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware('auth')->group(function () {
  Route::resource('categories', 'CategoryController');
  Route::resource('blocks', 'BlockController');
  Route::resource('pages', 'PageController');
  Route::resource('fields', 'FieldController');
  Route::resource('users', 'UserController');
  Route::resource('products', 'ProductController');
  Route::resource('budgets', 'BudgetController');
  Route::resource('orders', 'OrderController');
  Route::resource('contracts', 'ContractController');
  Route::resource('groups', 'GroupController');
  #Route::resource('admin/contacts', 'ContactController');

  //personales
	Route::post('pages/duplicate', ['as' => 'pages.duplicate', 'uses' => 'PageController@duplicate']);
});

Route::middleware('auth')->group(function () {
  Route::get('/home', 'WebController@index')->name('home');
  Route::get('/print', 'WebController@printview')->name('print');
  Route::get('/', 'WebController@index');
  Route::post('/cart', 'CartController@store');
  Route::get('/cart', 'CartController@index');
  Route::delete('/cart/{id}', 'CartController@destroy');
  Route::put('/cart/{id}', 'CartController@update');
  Route::post('/orders', 'OrderController@store');
  Route::get('/orders', 'OrderController@index');
});

Auth::routes();

Route::get('/contact', 'ContactController@index');
Route::post('/contact', 'ContactController@store');
Route::get('/migrar', 'WebController@migrar');

Route::get('/admin', function() {
	return redirect()->route('admin.orders.index');
});

//mis rutas
//Route::get('{category}/{slug}', 'WebController@page')->where('category', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
//Route::get('{slug}', 'WebController@category')->where('slug', '[a-z,0-9-]+');
