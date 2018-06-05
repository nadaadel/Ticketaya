<?php


Route::get('/test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "test";
});

Route::get('/', function(){
    return view('home' , compact('userNotifications'));
});

Route::post('/notification/auth' , 'NotificationsController@auth');


/** Search For Tickets */
Route::get('/tickets/filter' , 'FilterTicketsController@filter');

Route::get('/twilio' , 'TwilioController@sendVerifications');




/**Events Routes */
Route::get('/events' ,'EventsController@index')->name('allevents');
Route::get('/events/locations' , 'MapController@eventsLocation')->name('eventslocation');
Route::get('/events/create' , 'EventsController@create');
Route::post('/events/store' , 'EventsController@store');
Route::get('/events/{id}' , 'EventsController@show');
Route::get('/events/subscribe/{event_id}/{user_id}' , 'EventsController@subscribe');
Route::get('/events/unsubscribe/{event_id}/{user_id}' , 'EventsController@unsubscribe');
Route::post('/events/info/new/{id}', 'EventsController@newInfo');


/** Search For Tickets */
Route::post('/tickets/spam/{id}' , 'TicketsController@spamTicket');
Route::get('/tickets/requests' , 'TicketRequestsController@getUserRequests');
Route::post('/tickets/accept/{id}/{requester_id}' , 'TicketRequestsController@acceptTicket');
Route::post('/tickets/cancel/{id}/{requester_id}' , 'TicketRequestsController@cancelTicketRequest');
Route::post('/tickets/sold/{id}' , 'TicketRequestsController@ticketSold');
Route::get('/tickets/cancel/{id}','TicketRequestsController@cancelTicketSold');
Route::post('/tickets/request/edit/{id}','TicketRequestsController@editRequestedTicket');
Route::post('/tickets/request/{id}' , 'TicketRequestsController@requestTicket');


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
Route::post('/comments','CommentsController@store')->middleware('auth');
Route::get('/replies/{id}','RepliesController@show');
Route::post('/replies','RepliesController@store')->middleware('auth');


/** Ticket CRUD Operations */
Route::delete('/tickets/{id}','TicketsController@destroy');
Route::get('/tickets', 'TicketsController@index')->name('alltickets');
Route::get('/tickets/create', 'TicketsController@create')->name('createticket');
Route::post('/tickets/store', 'TicketsController@store')->name('storeticket');
Route::get('/tickets/edit/{id}', 'TicketsController@edit');

Route::get('/tickets/{id}' , 'TicketsController@show')->name('showticket');
Route::put('/tickets/update/{id}', 'TicketsController@update')->name('updateticket');
Route::post('/tickets/search','TicketsController@search');
Route::get('/tickets/filter' , 'FilterTicketsController@filter');




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');


/** Admin  */
Route::get('/admin', 'AdminsController@index')->name('admin');


/* Notifications */
Route::get('/notifications','NotificationsController@show');
Route::get('/notifications/allread','NotificationsController@updateAllRead');
Route::get('/notifications/{id}/edit','NotificationsController@edit');
