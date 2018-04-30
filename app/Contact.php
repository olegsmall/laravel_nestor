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
        $contact->ctc_categorie = request('contact-category');
        $contact->ctc_uti_id_ce = 1;

//        dd($contact);
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
        $telObj->tel_type = request('telephone-category');
        $telObj->tel_poste = request('post');
        $telObj->tel_ctc_id_ce = $this->ctc_id;


        // Print form fields as array
        $numTel = [];
//        var_dump($telObj->attributes);

        var_dump($telObj->attributes['tel_type']);
        foreach ($telObj->attributes['tel_numero'] as $champ) {
            $numTel[]['tel_numero'] = $champ;
            foreach ($numTel as $champs => $valeur) {
                echo $champs;
                $valeur[] = $telObj->attributes['tel_type'][$champs];
            }
        }



        var_dump($numTel);
//        var_dump($numTel);

//          Add multiple rows to table
//        $telNum = array(
//          array('tel_numero' => '1111', 'tel_type' => "Cellulaire", 'tel_poste' => '11', 'tel_ctc_id_ce' => 1),
//          array('tel_numero' => '2222', 'tel_type' => "Domicile", 'tel_poste' => '22', 'tel_ctc_id_ce' => 1)
//        );
//        DB::table('telephones')->insert($telNum);


//        dd($telObj->attributes);
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