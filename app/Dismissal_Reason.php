<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dismissal_Reason extends Model
{
     protected $fillable = [
    	'dismissal_id','reason','flag',
    ];
}
