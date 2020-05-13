<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([''], function(){
    Route::resource('warehouses', 'WarehouseController');
    Route::resource('address', 'AddressController'); 
    Route::resource('contacts', 'ContactController');
    Route::resource('customers', 'CustomerController');

    Route::put('warehouses/{warehouse}/address/{address}', 'WarehouseController@addAddress');
});

// Route::get('warehouses', 'WarehouseController@index');
// Route::get('warehouses/{warehouse}', 'WarehouseController@getWarehouse');
// Route::post('warehouses', 'WarehouseController@createWarehouse');
// Route::put('warehouses/{warehouse}', 'WarehouseController@updateWarehouse');
// Route::put('warehouses/{warehouse}/address/{address}', 'WarehouseController@addAddress');
// Route::delete('warehouses/{warehouse}', 'WarehouseController@deleteWarehouse');

// Route::get('address', 'AddressController@index');
// Route::get('address/{address}', 'AddressController@getAddress');
// Route::post('address', 'AddressController@createAddress');
// Route::put('address/{address}', 'AddressController@updateAddress');
// Route::delete('address/{address}', 'AddressController@deleteAddress');