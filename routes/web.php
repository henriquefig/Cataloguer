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

Route::get('/', function () {
	if(\Auth::check() && Auth::user()->role === 'admin'){
		return view('home');
	}
	else
    	return view('auth.login');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'LoginController@logout');


/* Routes for creating/uploading catalog fields/entries (create page) */
Route::post('/new_catalog','AjaxController@new_catalog')->name('Catalog creator');
Route::post('/catalog_fields','AjaxController@catalog_fields');
Route::post('/create_catalog','AjaxController@create_catalog');
Route::post('/upload','AjaxController@upload');


/* Routes for field mapping */
Route::post('/mapping','AjaxController@map_catalog');
Route::get('/mapping','AjaxController@map_catalog');
Route::post('/save_mapping','AjaxController@save_map');


/* Routes for product layouts */
Route::get('/layout','AjaxController@layout');
Route::post('/layout','AjaxController@layout');
Route::post('/save_styles','AjaxController@save_styles');
Route::get('/publish','AjaxController@publish');
Route::post('/publish','AjaxController@publish');


/* Routes for the catalog layouts */
Route::post('/page_layout','AjaxController@page_layout');
Route::get('/page_layout','AjaxController@page_layout');
Route::post('/save_p_layout','AjaxController@save_p_layout');
Route::post('/upload_comp','AjaxController@upload_comp');

/* Routes for the list of catalog entries */
Route::post('/list_catalog','AjaxController@list_catalog');
Route::get('/list_catalog','AjaxController@list_catalog');

/* Routes for the operations in the catalog entries */
Route::post('/new_entry','AjaxController@new_entry');
Route::post('/add_entry','AjaxController@add_entry');
Route::post('/save_entry','AjaxController@save_entry');
Route::post('/delete_entry','AjaxController@delete_entry');


/* Routes for published catalogs */
Route::post('/publish_catalog','AjaxController@publish_catalog');
Route::get('/loadMoreData','AjaxController@loadMoreData');
Route::post('/searchEntry','AjaxController@searchEntry');

/* Routes for exported catalogs */
Route::get('/exported','ExportController@index');
Route::get('/loadMoreDataG','ExportController@loadMoreDataGuest');
Route::post('/searchEntryG','ExportController@searchEntryGuest');

/* Routes for published/exported catalogs */




Auth::routes();