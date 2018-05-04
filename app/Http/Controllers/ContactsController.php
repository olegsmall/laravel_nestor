<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Contact;
use App\Telephone;

class ContactsController extends Controller {

    /**
     * ContactsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View -> /contact.tout
     */

	public function index()
    {
		$contacts = Contact::all()->where('ctc_uti_id_ce', '=', Auth::id()); // Contacts d'un utilisateur
        $updateContact = new Contact();
        $actionR = '/contact/add'; // route d'ajout
        $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie'); // Categories du champ ctc_categories de la table contacts
        $telephoneCategories = Contact::getValeursEnum('telephones', 'tel_type'); // Categories du champ tel_type de la table telephones
		return view( 'contact.tout',
            compact( 'contacts', 'contactCategories', 'telephoneCategories', 'updateContact', 'actionR') );
	}

    /**
     * @param Contact $contact - id contact
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector -> /contact
     */
	public function delete( Contact $contact )
    {
        if ($contact->ctc_uti_id_ce === Auth::id())
        {
            $contact->deleteContact();
        }
		return redirect( '/contact' );
	}

    /**
     * @param Contact $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View -> tout
     */
	public function edit( Contact $contact )
    {
        if ($contact->ctc_uti_id_ce === Auth::id())  // Verification d'utilisateur
        {
            $contacts = Contact::all()->where('ctc_uti_id_ce', '=', Auth::id());
            $updateContact = $contact;
            $actionR = "/contact/update/" . $contact->ctc_id; // route de modifiation
            $contactCategories = Contact::getValeursEnum('contacts', 'ctc_categorie');
            $telephoneCategories = Contact::getValeursEnum('telephones', 'tel_type');
        }
        return view( 'contact.tout',
            compact( 'contacts', 'contactCategories', 'telephoneCategories', 'updateContact', 'actionR') );
    }

    /**
     * @param Contact $contact - id contact
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector -> /contact
     */
	public function update( Contact $contact, Request $request )
    {
        if ($contact->ctc_uti_id_ce === Auth::id())
        {
            $contact->updateContact($this->getContactFormData($request));
        }

        return redirect( '/contact' );
    }


    /**
     * @param Contact $contact - id contact
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector -> /contact
     */

    public function add(Contact $contact, Request $request)
    {
            $contact->addContact($this->getContactFormData($request));
            return redirect("/contact");
    }

    private function getContactFormData($request)
    {
        return [
            'ctc_prenom' => $request->prenom,
            'ctc_nom' =>  $request->nom,
            'ctc_categorie' => $request->contact_category,
            'ctc_uti_id_ce' => Auth::id()
        ];
    }

}
