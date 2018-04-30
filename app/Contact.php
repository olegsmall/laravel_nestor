<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        $query = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$champ'" ))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $query, $matches);
        $valeurs = array();
        foreach (explode(',', $matches[1]) as $val) {
            $valeurs[] = trim($val, "'");
        }
        return $valeurs;
    }
}