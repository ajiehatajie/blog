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

/*
Route::get('/', function () {
    return view('welcome');
});
*/



Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{
		return View::make('welcome');
	});

	Route::get('test',function(){
		return View::make('test');
	});
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('register/verify/{token}', 'Auth\RegisterController@verify');


  Auth::routes();


  /*
    admin routes
  */
  Route::get('admin', 'Admin\AdminController@index');
  Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
  Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
  Route::resource('admin/roles', 'Admin\RolesController');
  Route::resource('admin/permissions', 'Admin\PermissionsController');
  Route::resource('admin/users', 'Admin\UsersController');
  Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
  Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
  Route::resource('admin/category', 'Admin\\CategoryController');

  /*
    end admin route
  */

});
