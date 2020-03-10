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

use App\Jobs\ProcessRawData;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pizza-details/{id}', 'HomeController@getPizzaDetails');
Route::get('/category/{id}', 'HomeController@getCategory');

 
Route::group(['middleware' => 'is_admin','prefix' => 'dashboard'], function() {
    Route::get('/api/process','ProcessRawController@processRaw');
    Route::post('/api/process/newMaterial','ProcessRawController@newMaterial');
    Route::post('/api/process/newMaterialAlias','ProcessRawController@newMaterialAlias');
    Route::get('/process',function(){
        return view('dashboard.pizza_process.index');
    });
    Route::get('/api/process/getmaterials','ProcessRawController@getmaterials');
    

	Route::get('/', 'AdminController@index');
    Route::resource('/websites', 'WebsitesController');
    Route::resource('/categories', 'CategoriesController');
    Route::patch('/links/set-item-schema', 'LinksController@setItemSchema');
    Route::post('/links/scrape', 'LinksController@scrape');
    Route::resource('/links', 'LinksController');
    Route::resource('/item-schema', 'ItemSchemaController');
    Route::resource('/pizzas', 'PizzasController');
    Route::resource('/links/{id}/edit', 'LinksController@edit');
    Route::resource('/pizza-types', 'PizzaTypesController');
});

Auth::routes();

