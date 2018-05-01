<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Telephone;

class ContactsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index() {
		$contacts = Contact::all();
        $updateContact = new Contact();
        $actionR = '/contact/add';
        $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie');
        $telephoneCategories = Contact::getValeursEnum('telephones', 'tel_type');
		return view( 'contact.tout',
            compact( 'contacts', 'contactCategories', 'telephoneCategories', 'updateContact', 'actionR') );
	}

//	public function show( Contact $contact ) { //Contact::find(wildcard);
//
//		return view( 'contact.un', compact( 'contact' ) );
//	}

	public function delete( Contact $contact ) {
        $contact->deleteContact();
		return redirect( '/contact' );
	}

	public function edit( Contact $contact ) {
        $contacts = Contact::all();
        $updateContact = $contact;
//        $actionR = "{{ route('edit.contact'), ['contact' => $contact->ctc_id] }}";
        $actionR = "/contact/update/" . $contact->ctc_id;
        $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie');
        $telephoneCategories = Contact::getValeursEnum('telephones', 'tel_type');

        return view( 'contact.tout',
            compact( 'contacts', 'contactCategories', 'telephoneCategories', 'updateContact', 'actionR') );
    }

	public function update( Contact $contact ) {
        $contact->updateContact();

        return redirect( '/contact' );
    }


    /**
     * Ajout d'un contact dans la BD
     * @return redirection sur la page des contacts
     */

    public function add(Contact $contact) {

        $contact->addContact($this->getContactFormData());

        return redirect("/contact");
    }

    private function getContactFormData(){
        return [
            'ctc_prenom' => request('prenom'),
            'ctc_nom' =>  request('nom'),
            'ctc_categorie' => request('contact-category'),
            'ctc_uti_id_ce' => 1
        ];
    }

    private function getTelephonesFormData(){

    }
}
