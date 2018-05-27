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
    return view('home');
});

Route::get('/spam/{id}' , 'TicketsController@spamTicket');


// Route::get('/tickets/requests' , 'TicketsController@getSellerRequests');
Route::get('/tickets/requests' , 'TicketsController@getUserRequests');

Route::post('/tickets/request/{id}' , 'TicketsController@requestTicket');


/** Tag CRUD Operations */
Route::get('/tags' , 'TagsController@allTags');
Route::post('/tags/create' , 'TagsController@create');
Route::get('/tags/show/{id}' , 'TagsController@show');
Route::get('/tags/edit/{id}' , 'TagsController@edit');
Route::put('/tags/update/{id}' , 'TagsController@update');
Route::delete('/tags/delete/{id}' , 'TagsController@delete');


/** Ticket CRUD Operations */
Route::get('/tickets/show/{id}' , 'TicketsController@show');
