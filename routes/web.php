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


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');
Route::get('/kategoriak', 'HomeController@pizzacategories');
Route::get('/kapcsolatok', 'HomeController@contacts');
Route::get('/pizzakategoriak', 'PizzaCategoryController@index');
Route::get('/pizza', 'PizzasController@show');




Route::get('/pizza-details/{id}', 'HomeController@getPizzaDetails');
Route::get('/category/{id}', 'HomeController@getCategory');

Route::post('/feedback', 'HomeController@storeFeedback');

Route::prefix('api')->group(function () {
    Route::get('/infinite_pizzas', 'PizzasController@infinitePizzas');
});


Route::group(['middleware' => 'is_admin','prefix' => 'dashboard'], function() {
    Route::get('/api/process','ProcessRawController@processRaw');

    Route::post('/api/process/newMaterial','ProcessRawController@newMaterial');
    Route::post('/api/process/newMaterialAlias','ProcessRawController@newMaterialAlias');
    Route::get('/api/process/getmaterials','ProcessRawController@getmaterials');
    Route::get('/api/process/getpizzas', 'ProcessRawController@getpizzas');
    Route::post('/api/process/newPizza', 'ProcessRawController@newPizza');
    Route::get('/api/process/refresh', 'ProcessRawController@refreshPizzaAliasRecept');
    Route::post('/api/process/newPizzaAlias','ProcessRawController@newPizzaAlias');
    Route::get('/process',function(){
        return view('dashboard.pizza_process.index');
    });
	Route::get('/', 'AdminController@index');
    Route::resource('/websites', 'Admin\WebsitesController');
    Route::resource('/categories', 'Admin\CategoriesController');
    Route::patch('/links/set-item-schema', 'Admin\LinksController@setItemSchema');
    Route::post('/links/scrape', 'Admin\LinksController@scrape');
    Route::resource('/links', 'Admin\LinksController');
    Route::resource('/item-schema', 'Admin\ItemSchemaController');
    Route::resource('/pizzas', 'PizzasController');
    Route::resource('/links/{id}/edit', 'Admin\LinksController@edit');
    Route::delete('/logs/delete_all', 'Admin\LogsController@deleteAll');
    Route::resource('/logs', 'Admin\LogsController');
    Route::delete('/raw_pizzas/delete_all', 'Admin\RawPizzaController@deleteAll');
    Route::delete('/raw_pizzas/{websiteId}/delete_pizzas', 'Admin\RawPizzaController@deletePizzas');
    Route::post('/raw_pizzas/banyai_load', 'Admin\RawPizzaController@banyaiPizzaFeltetLoad');
    Route::post('/raw_pizzas/forzaitalia_load', 'Admin\RawPizzaController@forzaitaliaPizzaLoad');
    Route::resource('/materials', 'Admin\MaterialController');
    Route::delete('/feedbacks/delete_all', 'Admin\FeedbackController@deleteAll');
    Route::resource('/feedbacks', 'Admin\FeedbackController');
    Route::resource('/pizza_categories', 'Admin\PizzaCategoryController');
});


Auth::routes();

