<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IntervenDept;
use App\Visit_interven;

class Interventions extends Model
{
 
    protected $fillable = ['id','interven_name','descrp'];
}

