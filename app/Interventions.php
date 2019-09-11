<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IntervenDept;
use App\Visit_interven;

class Interventions extends Model
{
 
    protected $fillable = ['id','parent','interven_name','descrp'];

     public function interven()
    {
        return $this->hasMany(IntervenDept::class,'interven');
    }

     public function interven_visit()
    {
        return $this->hasMany(Visit_interven::class,'interven_id');
    }
}
