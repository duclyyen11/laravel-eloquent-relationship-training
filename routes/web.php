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
    return view('welcome');
});

/*One to one relationship eloquent laravel */
Route::get("create-user", function(){
	$user = new App\User();
	$user->name = 'nguyentrungduc';
	$user->password = Hash::make('12345678');
	$user->email = 'ducnt220997@gmail.com';
	$user->save();

	return $user->save();
});

	//Create a phone by user Model
	Route::get("create-phone-by-user", function(){
		$user = App\User::find(1);

		$phone = new App\Phone();
		$phone->phone = '9429343852';
		 
		return $user->phone()->save($phone);
	});

	//Get phone per user
	Route::get("get-user-phone", function(){
		$user = App\User::find(1);

		dd([
			$user->phone(),
			$user->phone,
		]);
	});
/*One to one relationship eloquent laravel */