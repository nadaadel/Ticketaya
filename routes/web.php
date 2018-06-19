<?php



Route::get('/admin/index' , 'AdminsController@index')->name('admin-index');


/** Admin Articles Routes */
Route::get('/articles/create' , 'ArticlesController@create')->name('createarticle');
Route::get('/articles' , 'ArticlesController@index')->name('allarticles');
Route::get('/articles/{id}' , 'ArticlesController@show')->name('showarticle');
Route::get('/articles/edit/{id}' , 'ArticlesController@edit')->name('editarticle');
Route::post('/articles/store' , 'ArticlesController@store')->name('storearticle');
Route::put('/articles/{id}' , 'ArticlesController@update')->name('updatearticle');
Route::delete('/articles/{id}' , 'ArticlesController@delete')->name('deletearticle');


/** Admin Category Routes */
Route::get('/categories' , 'CategoriesController@index')->name('allcategories');
Route::get('/categories/create' , 'CategoriesController@create')->name('createcategory');
Route::get('/categories/{id}' , 'CategoriesController@show')->name('showcategory');
Route::get('/categories/edit/{id}' , 'CategoriesController@edit')->name('editcategory');
Route::post('/categories' , 'CategoriesController@store')->name('storecategory');
Route::put('/categories/{id}' , 'CategoriesController@update')->name('updatecategory');
Route::delete('/categories/{id}' , 'CategoriesController@delete')->name('deletecategory');


/** Map Routes */
Route::get('/tickets/locations' , 'MapController@ticketLocations')->name('ticketslocation');
Route::get('/events/locations' , 'MapController@eventsLocation')->name('eventslocation');


Route::get('/test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "test";
});

Route::get('/', function(){
    return view('home');
});

Route::post('/notification/auth' , 'NotificationsController@auth');


/** Search For Tickets */
Route::get('/tickets/filter' , 'FilterTicketsController@filter');



Route::get('/twilio' , 'TwilioController@sendVerifications');
/**Users route */
Route::get('/users/create','UsersController@create');
Route::get('/users/{id}','UsersController@show')->name('showuser');
Route::get('/users/edit/{id}','UsersController@edit');
Route::put('/users/{id}','UsersController@update');
Route::post('/users','UsersController@store');
Route::delete('/users/{id}' , 'UsersController@destroy');
Route::get('/users','UsersController@index')->name('allusers');
Route::get('/tickets/report/{id}','TicketsController@reportview')->middleware('auth');
Route::post('tickets/report','TicketsController@report');

/**Events Routes */
Route::get('/events/search' , 'EventsController@search');
Route::get('/events/filter' , 'FilterEventController@filter');
Route::get('/events' ,'EventsController@index')->name('allevents');
Route::get('/events/create' , 'EventsController@create')->middleware('auth');
Route::post('/events/store' , 'EventsController@store');
Route::get('/events/{id}' , 'EventsController@show')->name('eventshow');
Route::delete('/events/delete/{id}' , 'EventsController@delete');
Route::get('/events/edit/{id}','EventsController@edit')->middleware('auth');
Route::put('/events/{id}','EventsController@update')->middleware('auth');
Route::get('/events/subscribe/{event_id}/{user_id}' , 'EventsController@subscribe')->middleware('auth');
Route::get('/events/unsubscribe/{event_id}/{user_id}' , 'EventsController@unsubscribe')->middleware('auth');

Route::get('/events/question/{event_id}/{user_id}','EventsController@storeQuestion');
Route::delete('/questions/delete/{id}','EventsController@deleteQuestion');
Route::get('/events/answer/{event_id}/{user_id}','EventsController@updateQuestion');
Route::post('/events/info/new/{event_id}', 'EventsController@newInfo');
Route::delete('/events/info/delete/{id}', 'EventsController@deleteInfo');
Route::get('/events/filter/{category_id}' , 'FilterEventController@byCategory');


/** Search For Tickets */
Route::post('/tickets/spam/{id}' , 'TicketsController@spamTicket');
Route::get('/tickets/requests' , 'TicketRequestsController@getUserRequests');
Route::get('/tickets/accept/{id}/{requester_id}' , 'TicketRequestsController@acceptTicket');
Route::get('/tickets/cancel/{id}/{requester_id}' , 'TicketRequestsController@cancelTicketRequest');
Route::get('/tickets/sold/{id}' , 'TicketRequestsController@ticketSold');
Route::get('/tickets/cancel/{id}','TicketRequestsController@cancelTicketSold');
Route::post('/tickets/request/edit/{id}','TicketRequestsController@editRequestedTicket');
Route::post('/tickets/request/{id}' , 'TicketRequestsController@requestTicket');

Route::get('/categories' , 'CategoriesController@index')->name('allcategories');


/** Tag CRUD Operations */
Route::get('/tags' , 'TagsController@allTags')->name('alltags');
Route::get('/tags/create' , 'TagsController@create');
Route::post('/tags/store' , 'TagsController@store');
Route::get('/tags/show/{id}' , 'TagsController@show');
Route::get('/tags/edit/{id}' , 'TagsController@edit');
Route::put('/tags/update/{id}' , 'TagsController@update');
Route::delete('/tags/delete/{id}' , 'TagsController@delete');
Route::get('/tags/{id}/tickets' , 'TagsController@tagTickets')->name('tagTickets');



/** Ticket Comments */
Route::post('/comments','CommentsController@store')->middleware('auth');
Route::delete('/comments/delete/{id}','CommentsController@delete')->middleware('auth');
Route::get('/replies/{id}','RepliesController@show');
Route::post('/replies','RepliesController@store')->middleware('auth');


/** Ticket CRUD Operations */



Route::get('/tickets/saved_tickets' , 'TicketsController@showSavedTickets')->name('showSavedTickets');
Route::get('/tickets/search','TicketsController@search');
Route::delete('/tickets/{id}','TicketsController@destroy');
Route::get('/tickets', 'TicketsController@index')->name('alltickets');
Route::get('/tickets/requeted', 'TicketRequestsController@requestedTickets')->name('requestedtickets');
Route::get('/tickets/sold', 'TicketRequestsController@soldTickets')->name('soldtickets');

Route::get('/tickets/create', 'TicketsController@create')->name('createticket');
Route::post('/tickets/store', 'TicketsController@store')->name('storeticket');
Route::get('/tickets/edit/{id}', 'TicketsController@edit');

Route::get('/tickets/{id}' , 'TicketsController@show')->name('showticket');
Route::put('/tickets/update/{id}', 'TicketsController@update')->name('updateticket');
Route::get('/tickets/save/{id}' , 'TicketsController@saveTicket');
Route::get('/tickets/unsave/{id}' , 'TicketsController@unsaveTicket');
Route::get('/tickets/filter' , 'FilterTicketsController@filter');
Route::get('/tickets/filter/{id}' , 'FilterTicketsController@byCategory');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');


/** Admin  */
Route::get('/admin', 'AdminsController@index')->name('admin');




/* Notifications */
Route::get('/notifications','NotificationsController@show');
Route::get('/notifications/allread','NotificationsController@updateAllRead');
Route::get('/notifications/{id}/edit','NotificationsController@edit');




/* Cities */
Route::get('/cities/{id}','CitiesController@show');


/* article comments and replies*/
Route::post('article/comments','ArticleCommentsController@store');
Route::post('articles/replies','ArticleCommentRepliesController@store');
Route::get('articles/replies/{id}','ArticleCommentRepliesController@show');
Route::get('articles/likes/{id}','ArticlesController@like');
Route::get('articles/dislikes/{id}','ArticlesController@dislike');
