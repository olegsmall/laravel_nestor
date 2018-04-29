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

Route::get( '/', function () {
	$nom = "World";

//    return view('accueil', ['texte' => $nom]);
	return view( 'accueil' )->with( 'texte', $nom );
} );

//// Utilise QueryBuilder
//Route::get('/tache', function (){
//
//	//Query Builder
//	$taches = DB::table('tache')->where('accomplie', 1)->get();
//
//	return view( 'tache.tout' )->with('taches', $taches);
//});

//// Utilise QueryBuilder
//Route::get('/tache/{id}', function ($id){
//
//	//Query Builder
//	$taches = DB::table('tache')->where('accomplie', 1)->get();
//
//	return view( 'tache.un' )->with('texte', DB::table('tache')->find($id)->texte);
//});

//// Utilise Eloquent Model
//Route::get('/tache/{tache}', function (App\Tache $tache){
//		return view( 'tache.un' )->with('tache', $tache);
//});
//
//// Utilise QueryBuilder
//Route::get('/tache', function (){
//
//	//$taches = App\Tache::all();
////	$taches = App\Tache::all(['id', 'texte']);
//	$taches = Tache::all(['ctc_id', 'texte']);
//
//	return view( 'tache.tout' )->with('taches', $taches);
//});

Route::get( '/contact', function () {
	$contacts = Contact::all( '*' );

	return view( 'contact.tout' )->with( 'contacts', $contacts );
} );


Route::get( '/contact/{id}', function ( $id ) {
//    $contact = Contact::all('*')->firstWhere('ctc_id', $id);
	$editContactId = $id;
	$contacts      = Contact::all( '*' );

	return view( 'contact.tout' )
		->with( 'contact', $contacts )
		->with( 'editContactId', $editContactId );
} );

//TODO: not working like this
Route::get( '/contact/{id}/delete', function ( $id ) {

//	Contact::destroy($id);
	return redirect( '/contact' );
} );

/**
 * Code examples
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

	

	//Single variable
	return view( 'welcome' )->with( 'name', 'World' );
} );

