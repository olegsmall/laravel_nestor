<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
//    protected $table = 'contacts';
    public $timestaps = false;
	protected $primaryKey = 'ctc_id';

	/**
	 * Get the comments for the blog post.
	 */
	public function telephones()
	{
		return $this->hasMany('App\Telephone', 'tel_ctc_id_ce', "ctc_id");
	}
}
