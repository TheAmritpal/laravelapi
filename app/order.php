<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public $fillable = ['userId','address','contact','payment','total'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
