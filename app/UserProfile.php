<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserProfile extends Model
{
	protected $fillable = ['user_id','phone','image','address','city','country'];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
