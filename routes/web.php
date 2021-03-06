<?php

use App\Tache;
use App\Contact;

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

Auth::routes();
Route::get('/', 'ContactsController@index');
Route::get('/home', function (){return redirect('/');});

Route::get( '/contact', 'ContactsController@index' );
//Route::get( '/contact/{contact}', 'ContactsController@show' );
Route::get( '/contact/delete/{contact}', 'ContactsController@delete')->name('delete');
Route::get( '/contact/edit/{contact}', 'ContactsController@edit')->name('edit');
Route::post( '/contact/add', 'ContactsController@add')->name('add');
Route::post( '/contact/update/{contact}', 'ContactsController@update')->name('update');

/**
 * ************************************Code examples**************************************
 */
Route::get( '/example_multiple_variables', function () {
	//multiple variables as array in view function
	return view( 'welcome', [
		'name' => 'Laracasts',
		'age'  => 3
	] );

	$name = 'Jack';
	$age  = 3;

	return view( 'welcome', [
		'name' => $name,
		'age'  => $age
	] );

	return view( 'welcome', compact( 'name', 'age' ) );


	//Single variable
	return view( 'welcome' )->with( 'name', 'World' );
} );


/**
 * ******************* QueryBuilder Examples*******************
 */
Route::get( '/queryBuilderEcamples/{task}', function ( $id ) {

	// damp and die
	dd( $id );

	$tasks = DB::table( 'tasks' )->get();
	$tasks = DB::table( 'tasks' )->where( 'created_at', ">=" )->get();
	$tasks = DB::table( 'tasks' )->latest()->get();
	$task  = DB::table( 'tasks' )->fine( $id );
	dd( $task );

	return redirect( '/contact' );
} );


/**
 * ********************* Eloquent Model Examples ***********************
 */
Route::get( '/eloquent_Model_Examples/{task}', function ( $id ) {

	$contacts = Contact::all();
	$contacts = Contact::all()->first();
	$contacts = Contact::where( 'id', '>=', 2 )->get();
	//fetching only one column
	$contacts = Contact::pluck( 'nom' );
	$contact  = Contact::find( $id );
	//    $contact = Contact::all()->firstWhere('ctc_id', $id);

	return redirect( '/contact' );
} );


//
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
