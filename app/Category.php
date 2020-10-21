<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $table = 'categories';
    protected $fillable = ['categoryname','image'];
    public function products(){
        return $this->hasMany('App\Product');
    }
}
