<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Contact;
use App\Telephone;

class ContactsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index() {
		$contacts = Contact::all()->where('ctc_uti_id_ce', '=', Auth::id());
        $updateContact = new Contact();
        $actionR = '/contact/add';
        $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie');
        $telephoneCategories = Contact::getValeursEnum('telephones', 'tel_type');
		return view( 'contact.tout',
            compact( 'contacts', 'contactCategories', 'telephoneCategories', 'updateContact', 'actionR') );
	}

	public function delete( Contact $contact ) {
        if ($contact->ctc_uti_id_ce === Auth::id()) {
            $contact->deleteContact();
        }
		return redirect( '/contact' );
	}

	public function edit( Contact $contact ) {
        if ($contact->ctc_uti_id_ce === Auth::id()) {
            $contacts = Contact::all()->where('ctc_uti_id_ce', '=', Auth::id());
            $updateContact = $contact;
//        $actionR = "{{ route('edit.contact'), ['contact' => $contact->ctc_id] }}";
            $actionR = "/contact/update/" . $contact->ctc_id;
            $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie');
            $telephoneCategories = Contact::getValeursEnum('telephones', 'tel_type');
        }
        return view( 'contact.tout',
            compact( 'contacts', 'contactCategories', 'telephoneCategories', 'updateContact', 'actionR') );
    }

	public function update( Contact $contact, Request $request ) {
        if ($contact->ctc_uti_id_ce === Auth::id()) {
            $contact->updateContact($this->getContactFormData($request));
        }

        return redirect( '/contact' );
    }


    /**
     * Ajout d'un contact dans la BD
     * @return redirection sur la page des contacts
     */

    public function add(Contact $contact, Request $request) {
            $contact->addContact($this->getContactFormData($request));

            return redirect("/contact");
    }

    private function getContactFormData($request){
        return [
            'ctc_prenom' => $request->prenom,
            'ctc_nom' =>  $request->nom,
            'ctc_categorie' => $request->contact_category,
            'ctc_uti_id_ce' => Auth::id()
        ];
    }

//    private function getTelephonesFormData(){
//
//    }
}
