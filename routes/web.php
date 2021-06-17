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
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/rating', 'RatingController@index')->name('rating');
Route::get('/rating/create', 'RatingController@create')->name('add_rating');
Route::post('/rating', 'RatingController@store')->name('store_rating');
Route::get('/rating/edit/{id}', 'RatingController@edit')->name('edit_rating');
Route::put('/rating/update/{id}', 'RatingController@update')->name('update_rating');
Route::get('/rating/delete/{id}', 'RatingController@destroy')->name('delete_rating');
Route::post('/rating/load_ratings', 'RatingController@load_rating')->name('load_ratings');

Route::get('/tag', 'TagController@index')->name('tag');
Route::get('/tag/create', 'TagController@create')->name('add_tag');
Route::post('/tag', 'TagController@store')->name('store_tag');
Route::get('/tag/edit/{id}', 'TagController@edit')->name('edit_tag');
Route::put('/tag/update/{id}', 'TagController@update')->name('update_tag');
Route::get('/tag/delete/{id}', 'TagController@destroy')->name('delete_tag');
Route::post('/tag/load_tags', 'TagController@load_tags')->name('load_tags');

Route::get('/speaker', 'SpeakerController@index')->name('speaker');
Route::get('/speaker/create', 'SpeakerController@create')->name('add_speaker');
Route::post('/speaker', 'SpeakerController@store')->name('store_speaker');
Route::get('/speaker/edit/{id}', 'SpeakerController@edit')->name('edit_speaker');
Route::put('/speaker/update/{id}', 'SpeakerController@update')->name('update_speaker');
Route::get('/speaker/delete/{id}', 'SpeakerController@destroy')->name('delete_speaker');
Route::post('/speaker/load_speakers', 'SpeakerController@load_speakers')->name('load_speakers');

Route::get('/participants', 'ParticipantsController@index')->name('participants');
/*Route::get('/participants/create', 'ParticipantsController@create')->name('add_participants');
Route::post('/participants', 'ParticipantsController@store')->name('store_participants');
Route::get('/participants/edit/{id}', 'ParticipantsController@edit')->name('edit_participants');
Route::put('/participants/update/{id}', 'ParticipantsController@update')->name('update_participants');
Route::get('/participants/delete/{id}', 'ParticipantsController@destroy')->name('delete_participants'); */
Route::post('/participants/load_participant_talks', 'ParticipantsController@load_participant_talks')->name('load_participant_talks');
Route::get('/participants/show/{id}', 'ParticipantsController@show')->name('show_details');
Route::post('/participants/rating/{id}', 'ParticipantsController@store_rating')->name('submit_rating');

Route::get('/event', 'EventController@index')->name('event');
Route::get('/event/create', 'EventController@create')->name('add_event');
Route::post('/event', 'EventController@store')->name('store_event');
Route::get('/event/edit/{id}', 'EventController@edit')->name('edit_event');
Route::put('/event/update/{id}', 'EventController@update')->name('update_event');
Route::get('/event/delete/{id}', 'EventController@destroy')->name('delete_event');
Route::post('/event/load_events', 'EventController@load_events')->name('load_events');

Route::get('/talks', 'TalksController@index')->name('talks');
Route::get('/talks/create', 'TalksController@create')->name('add_talk');
Route::post('/talks', 'TalksController@store')->name('store_talk');
Route::get('/talks/edit/{id}', 'TalksController@edit')->name('edit_talk');
Route::put('/talks/update/{id}', 'TalksController@update')->name('update_talk');
Route::get('/talks/delete/{id}', 'TalksController@destroy')->name('delete_talk');
Route::post('/talks/search', 'TalksController@search')->name('search_talk');

Route::get('/search/top_speaker', 'SearchController@index')->name('top_speaker');
Route::post('/search/load_topspeaker', 'SearchController@top_speaker')->name('load_topspeaker');
Route::get('/search/sameday_talks', 'SearchController@sameday_talks')->name('sameday_talks');
Route::post('/search/load_sameday_talks', 'SearchController@load_sameday_talks')->name('load_sameday_talks');
Route::get('/search/event_talks', 'SearchController@event_talks')->name('event_talks');
Route::post('/search/load_event_talks', 'SearchController@load_event_talks')->name('load_event_talks');