<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['session_id','message','sender_id','receiver_id','type'];
}
