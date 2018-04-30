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

	public function delete( Contact $contact ) {
        $contact->deleteContact();
		return redirect( '/contact' );
	}

	public function update(Contact $contact) {
//        $contact->ctc_nom =
//        $contact.save();
    }


    /**
     * Ajout d'un contact dans la BD
     * @return redirection sur la page des contacts
     */

    public function add() {
        Contact::addContact();

        return redirect("/contact");
    }

}
