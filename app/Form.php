<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
	protected $perPage = 15; // The number of models to return for pagination.
	//protected $primaryKey = 'form_id';
	protected $casts = [
		'formName' => 'object'
	];
    public function users() {
        return $this->belongsToMany('App\User', 'osama');
    }

     
}
