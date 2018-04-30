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


    /**
     * Ajout d'un contact dans la BD
     * @return redirection sur la page des contacts
     */

    public function add(Contact $contact) {

        $contact = new Contact;
        $contact->ctc_prenom = request('prenom');
        $contact->ctc_nom = request('nom');
        $contact->ctc_categorie = request('categorie');
        $contact->ctc_uti_id_ce = 1;

        $contact->save(); // Ajout du contact

        $contact->ctc_id; // Recevoir id du contact ajoute dernierement
        return redirect("/contact");
    }

}
