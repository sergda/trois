<?php

// Home
Route::get('/', 'HomeController')->name('home');

// Language
Route::get('language/{lang}', 'LanguageController')
    ->where('lang', implode('|', config('app.languages')));

// Admin
Route::get('admin', 'AdminController')->name('admin');


// Medias
Route::get('medias', 'FilemanagerController')->name('medias');


// TestBlock
//Route::get('block-test/tag', 'TestBlockFrontController@tag');
Route::get('block-test/search', 'TestBlockFrontController@search');
Route::get('testblock/order', 'TestBlockController@indexOrder')->name('testblock.order');
Route::resource('testblock', 'TestBlockController', ['except' => 'show']);
Route::put('testblockpostseen/{id}', 'TestBlockAjaxController@updateSeen');
Route::put('testblockpostactive/{id}', 'TestBlockAjaxController@updateActive');

// rout front
Route::get('block-test', 'TestBlockFrontController@index');
Route::get('block-test/{testblock}', 'TestBlockFrontController@show')->name('testblock.show');





/* ******** World Tc { ************** */

Route::get('worldtc/order', 'WorldTcController@indexOrder')->name('worldtc.order');
Route::resource('worldtc', 'WorldTcController', ['except' => 'show']);
Route::put('worldtcpostseen/{id}', 'WorldTcAjaxController@updateSeen');
Route::put('worldtcpostactive/{id}', 'WorldTcAjaxController@updateActive');

// rout front
Route::get('world_tc', 'WorldTcFrontController@index');
Route::get('world_tc/{code}', 'WorldTcFrontController@show')->name('worldtc.show');

//image
Route::post('worldtcaddimage', 'ImagesProjectController@worldtcPostAddImageItem');

/* ******** } World Tc ************** */

/* ******** adm_collection { ************** */

Route::get('adm_collection/order', 'CollectionController@indexOrder')->name('collection.order');
Route::resource('adm_collection', 'CollectionController', ['except' => 'show']);
Route::put('adm_collectionpostseen/{id}', 'CollectionAjaxController@updateSeen');
Route::put('adm_collectionpostactive/{id}', 'CollectionAjaxController@updateActive');

// rout front
Route::get('collection', 'CollectionFrontController@index');
Route::get('collection/{code}', 'CollectionFrontController@show')->name('collection.show');

//image
Route::post('collectionaddimage', 'ImagesProjectController@collectionPostAddImageItem');

/* ******** } adm_collection ************** */


/* ******** adm_customer_service { ************** */

//Route::get('adm_customer_service/order', 'Customer_serviceController@indexOrder')->name('customer_service.order');
//Route::resource('adm_customer_service', 'Customer_serviceController', ['except' => 'show']);
//Route::put('adm_customer_servicepostseen/{id}', 'Customer_serviceAjaxController@updateSeen');
//Route::put('adm_customer_servicepostactive/{id}', 'Customer_serviceAjaxController@updateActive');

// rout front
//Route::get('customer_service', 'Customer_serviceFrontController@index');
//Route::get('customer_service/{code}', 'Customer_serviceFrontController@show')->name('customer_service.show');

//image
//Route::post('customer_serviceaddimage', 'ImagesProjectController@customer_servicePostAddImageItem');

/* ******** } adm_customer_service ************** */


/* ******** adm_find_us { ************** */

//Route::get('adm_find_us/order', 'Find_usController@indexOrder')->name('find_us.order');
//Route::resource('adm_find_us', 'Find_usController', ['except' => 'show']);
//Route::put('adm_find_uspostseen/{id}', 'Find_usAjaxController@updateSeen');
//Route::put('adm_find_uspostactive/{id}', 'Find_usAjaxController@updateActive');

// rout front
//Route::get('find_us', 'Find_usFrontController@index');
//Route::get('find_us/{code}', 'Find_usFrontController@show')->name('find_us.show');

//image
//Route::post('find_usaddimage', 'ImagesProjectController@find_usPostAddImageItem');

/* ******** } adm_find_us ************** */


/* ******** adm_order_catalogue { ************** */

//Route::get('adm_order_catalogue/order', 'Order_catalogueController@indexOrder')->name('order_catalogue.order');
//Route::resource('adm_order_catalogue', 'Order_catalogueController', ['except' => 'show']);
//Route::put('adm_order_cataloguepostseen/{id}', 'Order_catalogueAjaxController@updateSeen');
//Route::put('adm_order_cataloguepostactive/{id}', 'Order_catalogueAjaxController@updateActive');

// rout front
//Route::get('order_catalogue', 'Order_catalogueFrontController@index');
//Route::get('order_catalogue/{code}', 'Order_catalogueFrontController@show')->name('order_catalogue.show');

//image
//Route::post('order_catalogueaddimage', 'ImagesProjectController@order_cataloguePostAddImageItem');

/* ******** } adm_order_catalogue ************** */



Route::put('delete-image/{id}', 'ImagesProjectController@destroy');


// Blog 
//Route::get('blog/tag', 'BlogFrontController@tag');
Route::get('blog/search', 'BlogFrontController@search');
Route::get('articles', 'BlogFrontController@index');
Route::get('blog/order', 'BlogController@indexOrder')->name('blog.order');
Route::resource('blog', 'BlogController', ['except' => 'show']);
Route::put('postseen/{id}', 'BlogAjaxController@updateSeen');
Route::put('postactive/{id}', 'BlogAjaxController@updateActive');
Route::get('blog/{blog}', 'BlogFrontController@show')->name('blog.show');

// Comment
Route::resource('comment', 'CommentController', [
    'except' => ['create', 'show', 'update']
]);
Route::put('comment/{comment}', 'CommentAjaxController@update')->name('comment.update');
Route::put('commentseen/{id}', 'CommentAjaxController@updateSeen');

// Contact
Route::resource('contact', 'ContactController', ['except' => ['show', 'edit']]);

// Roles
Route::get('roles', 'RoleController@edit');
Route::post('roles', 'RoleController@update');

// Users
Route::get('user/sort/{role?}', 'UserController@index');
Route::get('user/blog-report', 'UserController@blogReport')->name('user.blog.report');
Route::resource('user', 'UserController', ['except' => 'index']);
Route::put('uservalid/{id}', 'UserAjaxController@valid');
Route::put('userseen/{user}', 'UserAjaxController@updateSeen');

// Authentication 
Auth::routes();

// Email confirmation 
Route::get('resend', 'Auth\RegisterController@resend');
Route::get('confirm/{token}', 'Auth\RegisterController@confirm');

// Notifications
Route::get('notifications/{user}', 'NotificationController@index');
Route::put('notifications/{notification}', 'NotificationController@update');