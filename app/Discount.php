<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ["delivery", "user_id", "action", "minutes"];
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
