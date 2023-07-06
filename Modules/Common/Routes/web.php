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



Route::group(

    [

        'prefix' => LaravelLocalization::setLocale(),

        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']

    ],

    function()

    {



        Route::get('switch-language/{code}', 'GlobalController@switchLanguage')->name('switch-language');
        Route::get('select-image/{media_id}/{tableName}/{model_id}', 'GlobalController@selectImage')->name('select-image');
        Route::get('/dashboard', 'CommonController@index')->name('dashboard')->middleware('loginCheck');
        
        Route::get('/import', 'CommonController@getImport')->name('import')->middleware('loginCheck');
        Route::post('/importPost', 'CommonController@uploadFile')->name('importPost')->middleware('loginCheck');
      

        Route::get('/importupdate', 'CommonController@getImportupdate')->name('importupdate')->middleware('loginCheck');
        Route::post('/importPostupdate', 'CommonController@uploadFileupdate')->name('importPostupdate')->middleware('loginCheck');
        
        // Route::post('/import_parse', 'CommonController@parseImport')->name('import_parse')->middleware('loginCheck');
        // Route::post('/import_process', 'CommonController@processImport')->name('import_process')->middleware('loginCheck');

        Route::get('/importcompanyproduct', 'CommonController@importcompanyproduct')->name('importcompanyproduct')->middleware('loginCheck');
        Route::post('/importcompanyproductupdate', 'CommonController@importcompanyproductupdate')->name('importcompanyproductupdate')->middleware('loginCheck');

      
        // Route::get('/importproduct', 'CommonController@importproduct')->name('importproduct')->middleware('loginCheck');
        // Route::post('/importproductupdate', 'CommonController@importproductupdate')->name('importproductupdate')->middleware('loginCheck');
      

        


            Route::prefix('common')->group(function() {
                Route::delete('/delete', 'GlobalController@postDelete')->name('delete');
                Route::get('/edit-info/{page_name}/{param1?}/{param2?}/{param3?}', 'GlobalController@editInfo')->name('edit-info')->where('param1', '(.*)');



        });



    });

