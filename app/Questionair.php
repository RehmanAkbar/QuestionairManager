<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionair extends Model
{
    protected $table = "questionairs";

    protected $fillable = ['user_id','name' ,'duration','type' ,'resumeable','published'];

    public $timestamps = true;

    public function questions(){

        return $this->hasMany('App\Question');
    }
}
