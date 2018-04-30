<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Telephone;

class ContactsController extends Controller {
	public function index() {
		$contacts = Contact::all();
        $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie');
		return view( 'contact.tout', compact( 'contacts', 'contactCategories' ) );
	}

//	public function show( Contact $contact ) { //Contact::find(wildcard);
//
//		return view( 'contact.un', compact( 'contact' ) );
//	}

	public function delete( $contact ) {
	    Telephone::destroy(Contact::find($contact)->telephones);
		Contact::destroy($contact);
		return redirect( '/contact' );
//
	}

	public function update(Contact $contact) {
//        $contact->ctc_nom =
//        $contact.save();
    }

    public function add() {



    }

}
