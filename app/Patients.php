<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Departments;
use App\Visit_interven;

class Patients extends Model
{ 

    use Notifiable;
    
	protected $fillable = [
		'patient_id','fname','lname','mname','age','birthdate','birthorder','address_id','contact','gender','civil_status','nationality','religion','case','submission','status','date_admitted','department_id','flag',
	];

	 public function departments()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Address','address_id');
    }

    public function deps()
    {
        return $this->belongsTo('Departments::class');
    }

    public function interven()
    {
        return $this->hasMany(Visit_interven::class,'patient_id');


    }


}
