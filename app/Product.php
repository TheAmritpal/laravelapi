<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $table = 'products';
    protected $fillable = ['product','price','categoryid','description','image'];
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function orderDetail(){
        return $this->hasMany('App\OrderDetail');
    }
}
