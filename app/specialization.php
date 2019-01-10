<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class specialization extends Model
{
	public $timestamps = false;
    protected $fillable = [
     	'specialization_name', 'college_id'
    ];
}
