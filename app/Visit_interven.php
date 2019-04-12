<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events;
use App\Patients;
use App\Interventions;


class Visit_interven extends Model
{
    protected $fillable = [
        'patient_id','interven_id','event_id','remarks'
    ];

     public function patient()
    {
       return $this->belongsTo('App\Patients','patient_id');
    }

      public function intervention()
    {
       return $this->belongsTo('App\Interventions','interven_id');
    }

     public function events()
    {
       return $this->belongsTo('App\Events','event_id');
    }
}
