<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
    	'parent','name','has_sublist','flag',
    ];
}
 