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
Auth::routes();

Route::get('/', function () {
    return View('auth.login');
});


Route::prefix('api')->group(function () {
  Route::get('employee/index','EmployeeController@index');
  Route::post('employee/store','EmployeeController@store');
  Route::delete('employee/destroy/{employee}','EmployeeController@destroy');
  Route::get('employee/show/{employee}','EmployeeController@show');
  Route::put('employee/update/{employee}','EmployeeController@update');
});


Route::get('/home', 'HomeController@index')->name('home');

// CATCH ALL ROUTE =============================  
// all routes that are not home or api will be redirected to the frontend 
// this allows angular to route them 
// 
Route::any('{all}', function(){
    return View('auth.login');
})->where('all', '.*');








