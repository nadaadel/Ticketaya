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
Route::post('/tags/create' , 'TagsController@create');
Route::get('/tags/show/{id}' , 'TagsController@show');
Route::get('/tags/edit/{id}' , 'TagsController@edit');
Route::put('/tags/update/{id}' , 'TagsController@update');
Route::delete('/tags/delete/{id}' , 'TagsController@delete');


/** Ticket CRUD Operations */
Route::get('/tickets/show/{id}' , 'TicketsController@show');
