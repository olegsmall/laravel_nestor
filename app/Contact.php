<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Telephone;

class Contact extends Model
{
//    protected $table = 'contacts';
    public $timestamps = false;
    protected $primaryKey = 'ctc_id';

    /**
     * Get the comments for the blog post.
     */
    public function telephones()
    {
        return $this->hasMany('App\Telephone', 'tel_ctc_id_ce', "ctc_id");
    }


    /**
     * Cherche les valeurs des champs enum de la BD
     * @param String $table Nom de la table BD
     * @param String $champ Nom du champ BD
     * @return array valeur/s du champ demandée
     */

    public static function getValeursEnum($table, $champ)
    {
        $query = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$champ'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $query, $matches);
        $valeurs = array();
        foreach (explode(',', $matches[1]) as $val) {
            $valeurs[] = trim($val, "'");
        }
        return $valeurs;
    }

    public static function addContact(){
        $contact = new Contact();
        $contact->ctc_prenom = request('prenom');
        $contact->ctc_nom = request('nom');
        $contact->ctc_categorie = request('categorie');
        $contact->ctc_uti_id_ce = 1;

        $contact->save(); // Ajout du contact

        $contact->ctc_id; // Recevoir id du contact ajoute dernierement
        $contact->addTelephone();
    }

    public function addTelephone()
    {

//        Telephone::create([
//            'tel_ctc_id_ce' => $this->ctc_id,
//            'tel_numero' => $telephone,
//            'tel_type' => $type,
//            'tel_poste' => $post
//        ]);
        $telObj = new Telephone();
        $telObj->tel_numero = request('tel');
        $telObj->tel_type = 'Autre';
        $telObj->tel_poste = '';
        $telObj->tel_ctc_id_ce = $this->ctc_id;

        $telObj->save();
    }

    public function deleteContact()
    {
        foreach ($this->telephones as $telephone) {
            $telephone->delete();
        }
        $this->delete();
    }
}