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
Route::get('/tags/{id}/tickets' , 'TagsController@tagTickets');






/**Comments */
Route::post('/comments','CommentsController@store');

Route::get('/replies/{id}','RepliesController@show');
Route::post('/replies','RepliesController@store');


/** Ticket CRUD Operations */

Route::delete('/tickets/{id}','TicketsController@destroy');
Route::get('/tickets', 'TicketsController@index');
Route::get('/tickets/create', 'TicketsController@create');
Route::post('/tickets/store', 'TicketsController@store');
Route::get('/tickets/edit/{id}', 'TicketsController@edit');
Route::get('/tickets/search' , 'TicketsController@search');
Route::get('/tickets/{id}' , 'TicketsController@show');
Route::put('/tickets/update/{id}', 'TicketsController@update');
Route::post('/tickets/search','TicketsController@search');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** Admin  */
Route::get('/admin', 'AdminsController@index')->name('admin');

