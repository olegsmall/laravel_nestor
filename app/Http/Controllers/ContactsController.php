<?php

namespace App\Http\Controllers;

use App\Contact;

class ContactsController extends Controller {
	public function index() {
		$contacts = Contact::all();

		return view( 'contact.tout', compact( 'contacts' ) );
	}

	public function show( Contact $contact ) { //Contact::find(wildcard);

		return view( 'contact.un', compact( 'contact' ) );
	}

	public function delete( $contact ) {
		Contact::destroy($contact);
		return redirect( '/contact' );
//
	}
}
