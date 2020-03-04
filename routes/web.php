<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');



Auth::routes();
Route::group(['middleware' => 'auth'], function (){
Route::resource('customers', 'CustomersController')->except('show','destroy');
Route::get('/customer/delete/{id}', 'CustomersController@destroy')->name('customers.delete');
Route::get('/orders', 'OrderController@index')->name('orders.all');
Route::get('/order/create', 'OrderController@create')->name('order.create');
Route::post('/order/store', 'OrderController@store')->name('order.store');
Route::get('/order/edit/{order}', 'OrderController@edit')->name('order.edit');
Route::post('/order/update/{id}', 'OrderController@update')->name('orders.update');
Route::get('/order/delete/{id}', 'OrderController@destroy')->name('order.delete');
Route::get('/order/assign/{order}', 'OrderController@asign')->name('order.assign.view');
Route::post('/order/assign/{order}', 'OrderController@assingOrderToCustomer')->name('order.assign');
Route::get('/customer/order/{id}', 'CustomersController@customerOders')->name('customers.order.view');
Route::get('/order/contract/{id}', 'OrderController@contract')->name('order.contracts.view');

Route::get('/restore', 'HomeController@deletedItems')->name('customers.orders.restore.view');
Route::get('/restore/customer/{id}', 'CustomersController@restoreCustomer')->name('customers.restore');
Route::get('/restore/order/{id}', 'OrderController@restoreOrder')->name('orders.restore');

});