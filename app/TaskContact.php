<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskContact extends Model
{
    protected $fillable = [ 
    	'contact_id','user_id', 'title', 'task' , 'priority', 'duedate'
     ] ;
     public function project() {
     	return $this->belongsTo('App\Contact');
     }
     public function user() {
         return $this->belongsTo('App\User');
     }
}