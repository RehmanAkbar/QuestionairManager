<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['name' ,'type'];

    public $timestamps = true;


    public function questionair(){

        return $this->belongsTo('App\Questionair');
    }

    public function answers(){

        return $this->hasMany('App\Answer');
    }
}
