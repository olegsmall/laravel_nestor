<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Telephone;

class Contact extends Model
{

    public $timestamps = false; // Annuler les timestamps
    protected $primaryKey = 'ctc_id'; // Deffinition de la PK
    protected $fillable = ['ctc_prenom', 'ctc_nom', 'ctc_categorie', 'ctc_uti_id_ce']; // Permition d'assignatin des champs specifiques

    /**
     * Chercher les telephones dans la BD
     * return array donnees des contacts
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

    /**
     * Ajouter un contact
     * @param array Represent les donnees du formulaire rempli par utilisateur
     */

    public function addContact($arContact)
    {
        $this->fill($arContact);
        $this->save();
        $this->addTelephones();
    }

    /**
     * Ajouter un contact
     * @param array Represent les donnees du formulaire rempli par utilisateur
     */

    public function updateContact($arContact)
    {
        $this->fill($arContact);
        $this->save();
        foreach ($this->telephones as $telephone) {
            $telephone->delete();
        }
        $this->addTelephones();
    }

    /**
     * Ajouter un telephone pour un contact
     */

    public function addTelephones()
    {
        for ($i=0; $i < count(request('tel')); $i++) {
            $telObj = new Telephone();
            $telObj->tel_numero = request('tel')[$i];
            $telObj->tel_type = request('telephone-category')[$i];
            $telObj->tel_poste = (request('post')[$i] != null) ? request('post')[$i] : '';
            $telObj->tel_ctc_id_ce = $this->ctc_id;
            $telObj->save();
        }
    }

    /**
     * Supprimer un contact
     */
    public function deleteContact()
    {
            foreach ($this->telephones as $telephone) {
                $telephone->delete();
            }
            $this->delete();
    }
}