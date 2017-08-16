<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['answer','correct'];

    public $timestamps = true;


    public function question(){

        return $this->belongsTo('App\Question');
    }
}
