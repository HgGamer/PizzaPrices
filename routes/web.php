<?php
use App\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/kategoriak/{slug}', 'PizzaCategoryController@pizzasForCategory');
Route::get('/kategoriak', 'HomeController@pizzacategories');
Route::get('/kapcsolatok', 'HomeController@contacts');
Route::get('/pizza/{id}', 'PizzasController@show');
Route::get('/pizzapicker', 'PizzaPickerController@index');




Route::get('/pizza-details/{id}', 'HomeController@getPizzaDetails');
Route::get('/category/{id}', 'HomeController@getCategory');
Route::get('/tesztu', 'Admin\LinksController@sendEmail');
Route::get('/report', 'Admin\LinksController@generateScrapeReport');

Route::post('/feedback', 'HomeController@storeFeedback');

Route::prefix('api')->group(function () {
    Route::get('/infinite_pizzas', 'PizzasController@infinitePizzas');
    Route::get('/infinite_pizzas100', 'PizzasController@infinite100Pizzas');
    Route::post('/pizzasByMaterials', 'PizzasController@pizzasByMaterials');
    Route::get('/pizza_categories', 'PizzaCategoryController@getAllCategories');
    Route::get('/pizzas_by_category_id/{id}', 'PizzasController@pizzasByCategoryId');
    Route::get('/pizzas_by_id/{id}', 'PizzasController@pizzasById');
    Route::post('/pizzasearch', 'PizzasController@pizzaSearch');
});


Route::group(['middleware' => 'is_admin','prefix' => 'dashboard'], function() {
    Route::get('/api/process','ProcessRawController@processRaw');

    Route::post('/api/process/newMaterial','ProcessRawController@newMaterial');
    Route::post('/api/process/newMaterialAlias','ProcessRawController@newMaterialAlias');
    Route::get( '/api/process/getmaterials','ProcessRawController@getmaterials');
    Route::get( '/api/process/getpizzas', 'ProcessRawController@getpizzas');
    Route::post('/api/process/newPizza', 'ProcessRawController@newPizza');
    Route::get( '/api/process/refresh', 'ProcessRawController@refreshPizzaAliasRecept');
    Route::post('/api/process/newPizzaAlias','ProcessRawController@newPizzaAlias');
    Route::post('/api/process/joinMaterials','ProcessRawController@JoinMaterials');
    Route::post('/api/process/joinPizzas','ProcessRawController@JoinPizzas');
    Route::post('/api/process/setProcessID','ProcessRawController@setProcessID');
    Route::get( '/api/process/getAllNewMaterial','ProcessRawController@getAllNewMaterial');
    Route::post('/api/process/newAdditionalMaterial','ProcessRawController@newAdditionalMaterial');
    Route::get( '/api/process/deleteBadAliases','ProcessRawController@deleteBadAliases');
    Route::get( '/api/process/generateImages','GenerationController@generateImages');


    Route::get('/process',function(Request $request){
        $sites = Website::all();
        $processid = $request->session()->get('processID');

        if($processid == null){
            $processid = 1;
        }

        return view('dashboard.pizza_process.index')->withsites($sites)->withprocessid($processid);
    });
	Route::get('/', 'AdminController@index');
    Route::resource('/websites', 'Admin\WebsitesController');
    Route::resource('/categories', 'Admin\CategoriesController');
    Route::patch('/links/set-item-schema', 'Admin\LinksController@setItemSchema');
    Route::post('/links/scrape', 'Admin\LinksController@scrape');
    Route::get('/links/scrapeAll', 'Admin\LinksController@scrapeAll');
    Route::resource('/links', 'Admin\LinksController');
    Route::resource('/item-schema', 'Admin\ItemSchemaController');
    Route::resource('/links/{id}/edit', 'Admin\LinksController@edit');
    Route::delete('/logs/delete_all', 'Admin\LogsController@deleteAll');
    Route::resource('/logs', 'Admin\LogsController');
    Route::delete('/raw_pizzas/delete_all', 'Admin\RawPizzaController@deleteAll');
    Route::delete('/raw_pizzas/{websiteId}/delete_pizzas', 'Admin\RawPizzaController@deletePizzas');
    Route::post('/raw_pizzas/banyai_load', 'Admin\RawPizzaController@banyaiPizzaFeltetLoad');
    Route::post('/raw_pizzas/forzaitalia_load', 'Admin\RawPizzaController@forzaitaliaPizzaLoad');
    Route::post('/raw_pizzas/happyhot_load', 'Admin\RawPizzaController@happyhotPizzaLoad');
    Route::post('/raw_pizzas/pizzafalo_load', 'Admin\RawPizzaController@pizzafaloPizzaLoad');
    Route::post('/raw_pizzas/forte_load', 'Admin\RawPizzaController@fortePizzaLoad');
    Route::get('/materials/by_ids', 'Admin\MaterialController@materialsByIDs');
    Route::patch('/material/set-material-category', 'Admin\MaterialController@setMaterialsCategory');
    Route::resource('/materials', 'Admin\MaterialController');
    Route::delete('/feedbacks/delete_all', 'Admin\FeedbackController@deleteAll');
    Route::resource('/feedbacks', 'Admin\FeedbackController');
    Route::resource('/pizza_categories', 'Admin\PizzaCategoryController');
    Route::resource('/materials_categories', 'Admin\MaterialsCategoryController');
    Route::resource('/fusion', 'Admin\FusionController');
    Route::patch('/pizzas/set-pizza-category', 'Admin\PizzasController@setPizzaCategory');
    Route::patch('/pizzas/set-pizza-category2', 'Admin\PizzasController@setPizzaCategory2');
    Route::patch('/pizzas/set-pizza-category3', 'Admin\PizzasController@setPizzaCategory3');
    Route::resource('/pizzas', 'Admin\PizzasController');
    Route::delete('/storedatas/delete/{id}', 'Admin\PizzasController@deleteStoreData');


});


Auth::routes();

