<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'tel_id';
	/**
	 * Get the contact that owns the phone number.
	 */
//	public function contact()
//	{
//		return $this->belongsTo('App\Contact', 'tel_ctc_id_ce')->withDefault();
//	}
}
