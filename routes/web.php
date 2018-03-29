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
Route::put('worldtcpostis_menu/{id}', 'WorldTcAjaxController@updateIsMenu');

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
Route::put('adm_collectionpostis_menu/{id}', 'CollectionAjaxController@updateIsMenu');
// rout front
Route::get('collection', 'CollectionFrontController@index');
Route::get('collection/{code}', 'CollectionFrontController@show')->name('collection.show');

//image
Route::post('collectionaddimage', 'ImagesProjectController@collectionPostAddImageItem');

/* ******** } adm_collection ************** */


/* ******** adm_customer_service { ************** */

Route::get('adm_customerservice/order', 'CustomerServiceController@indexOrder')->name('customerservice.order');
Route::resource('adm_customerservice', 'CustomerServiceController', ['except' => 'show']);
Route::put('adm_customerservicepostseen/{id}', 'CustomerServiceAjaxController@updateSeen');
Route::put('adm_customerservicepostactive/{id}', 'CustomerServiceAjaxController@updateActive');
Route::put('adm_customerservicepostis_menu/{id}', 'CustomerServiceAjaxController@updateIsMenu');
// rout front
Route::get('customer_service', 'CustomerServiceFrontController@index');
Route::get('customer_service/{code}', 'CustomerServiceFrontController@show')->name('customerservice.show');

//image
Route::post('customerserviceaddimage', 'ImagesProjectController@customerServicePostAddImageItem');

/* ******** } adm_customer_service ************** */


/* ******** adm_find_us { ************** */

Route::get('adm_findus/order', 'FindUsController@indexOrder')->name('findus.order');
Route::resource('adm_findus', 'FindUsController', ['except' => 'show']);
Route::put('adm_finduspostseen/{id}', 'FindUsAjaxController@updateSeen');
Route::put('adm_finduspostactive/{id}', 'FindUsAjaxController@updateActive');
Route::put('adm_finduspostis_menu/{id}', 'FindUsAjaxController@updateIsMenu');
// rout front
Route::get('find_us', 'FindUsFrontController@index');
Route::get('find_us/{code}', 'FindUsFrontController@show')->name('findus.show');

//image
Route::post('findusaddimage', 'ImagesProjectController@findUsPostAddImageItem');

/* ******** } adm_find_us ************** */


/* ******** adm_order_catalogue { ************** */
Route::get('order-catalogue', 'OrderCatalogueFrontController@show');
/* ******** } adm_order_catalogue ************** */



Route::put('delete-image/{id}', 'ImagesProjectController@destroy');

Route::post('/send.json', 'HomeController@postSend');

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