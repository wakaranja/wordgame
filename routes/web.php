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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/categories',[
  'uses'=>'CategoryController@index',
  'as'=>'categories'
]);

Route::post('/addcategory',[
  'uses'=>'CategoryController@store',
  'as'=>'addcategory'
]);

Route::get('/showcategory/{id}',[
  'uses'=>'CategoryController@show',
  'as'=>'showcategory'
]);

Route::get('/editcategory/{id}',[
  'uses'=>'CategoryController@edit',
  'as'=>'editcategory'
]);

Route::post('/updatecategory/{id}',[
  'uses'=>'CategoryController@update',
  'as'=>'updatecategory'
]);

Route::get('/deletecategory/{id}',[
  'uses'=>'CategoryController@destroy',
  'as'=>'deletecategory'
]);

Route::get('/entries',[
  'uses'=>'EntryController@index',
  'as'=>'entries'
]);

Route::post('/addentry',[
  'uses'=>'EntryController@store',
  'as'=>'addentry'
]);

Route::get('/editentry/{id}',[
  'uses'=>'EntryController@edit',
  'as'=>'editentry'
]);

Route::post('/updateentry/{id}',[
  'uses'=>'EntryController@update',
  'as'=>'updateentry'
]);

Route::get('/deleteentry/{id}',[
  'uses'=>'EntryController@destroy',
  'as'=>'deleteentry'
]);

Route::get('/games',[
  'uses'=>'GameController@index',
  'as'=>'games'
]);

Route::get('/newgame',[
  'uses'=>'GameController@store',
  'as'=>'newgame'
]);

Route::get('/newround/{id}',[
  'uses'=>'GameController@newround',
  'as'=>'newround'
]);

Route::get('/gamesetup/{id}',[
  'uses'=>'GameController@show',
  'as'=>'gamesetup'
]);

Route::get('/addgamecategory/{game_id}/{category_id}',[
  'uses'=>'GameController@addgamecategory',
  'as'=>'addgamecategory'
]);

Route::get('/deletegamecategory/{game_id}/{category_id}',[
  'uses'=>'GameController@deletegamecategory',
  'as'=>'deletegamecategory'
]);

Route::get('/deletegame/{id}',[
  'uses'=>'GameController@destroy',
  'as'=>'deletegame'
]);

Route::get('/playgame/{game_id}',[
  'uses'=>'GameController@playgame',
  'as'=>'playgame'
]);

Route::post('/gamescore',[
  'uses'=>'GamescoreController@store',
  'as'=>'gamescore'
]);

Route::get('/waiting/{id}',[
  'uses'=>'GamescoreController@waiting',
  'as'=>'waiting'
]);

Route::get('/loadresults/{game_id}',[
  'uses'=>'GamescoreController@loadresults',
  'as'=>'loadresults'
]);

Route::get('/leavegame/{game_id}',[
  'uses'=>'GameController@leavegame',
  'as'=>'leavegame'
]);

Route::get('/janja',[
  'uses'=>'GameController@janja',
  'as'=>'janja'
]);
