<?php

Route::get('/test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "test";
});


Route::get('/request', function () {

    event(new App\Events\TicketRequested('Tamer Hosny Ticket' , 'Nada'));
    return "Your Ticket Request Sent!";
});



Route::get('/', function(){
    return view('home');
});

Route::post('/notification/auth' , 'NotificationsController@auth');



/** Search For Tickets */
Route::get('/tickets/filter' , 'FilterTicketsController@filter');



/**Events Routes */
Route::get('/events/locations' , 'MapController@eventsLocation');



/** Search For Tickets */
Route::get('/tickets/filter' , 'FilterTicketsController@filter');
Route::post('/tickets/spam/{id}' , 'TicketsController@spamTicket');
Route::get('/tickets/requests' , 'TicketsController@getUserRequests');
Route::post('/tickets/accept/{id}/{requester_id}' , 'TicketsController@acceptTicket');
Route::post('/tickets/cancel/{id}/{requester_id}' , 'TicketsController@cancelTicketRequest');
Route::post('/tickets/sold/{id}' , 'TicketsController@ticketSold');
Route::get('/tickets/cancel/{id}','TicketsController@cancelTicketSold');
Route::post('/tickets/request/edit/{id}','TicketsController@editRequestedTicket');
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



/** Ticket Comments */
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

/* Notifications */
Route::get('/notifications','NotificationsController@show');
Route::get('/notifications/allread','NotificationsController@updateAllRead');
Route::get('/notifications/{id}/edit','NotificationsController@edit');
