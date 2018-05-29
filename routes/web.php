<?php

Route::get('/', function () {
    return view('home');
});

Route::post('/tickets/spam/{id}' , 'TicketsController@spamTicket');


Route::get('/tickets/requests' , 'TicketsController@getUserRequests');
Route::post('/tickets/accept/{id}/{requester_id}' , 'TicketsController@acceptTicket');
Route::post('/tickets/cancel/{id}/{requester_id}' , 'TicketsController@cancelTicketRequest');



Route::post('/tickets/sold/{id}' , 'TicketsController@ticketSold');
Route::post('/tickets/request/{id}' , 'TicketsController@requestTicket');


/** Tag CRUD Operations */
Route::get('/tags' , 'TagsController@allTags');
Route::get('/tags/create' , 'TagsController@create');
Route::post('/tags/store' , 'TagsController@store');
Route::get('/tags/show/{id}' , 'TagsController@show');
Route::get('/tags/edit/{id}' , 'TagsController@edit');
Route::put('/tags/update/{id}' , 'TagsController@update');
Route::delete('/tags/delete/{id}' , 'TagsController@delete');


/** Ticket CRUD Operations */
Route::get('/tickets/show/{id}' , 'TicketsController@show');
Route::get('/tickets' , 'TicketsController@index');

/**Comments */
Route::post('/tickets/{id}/comment','CommentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** Admin  */
Route::get('/admin', 'AdminsController@index')->name('admin');