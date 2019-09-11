<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services;

class Display extends Model
{
	
	protected $table = 'display';

	protected $fillable = [
    	'service_id','role',
    ];

    public function services()
	{
	  return $this->belongsTo('App\Services', 'service_id');
	}
}
