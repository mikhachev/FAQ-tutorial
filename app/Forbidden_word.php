<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forbidden_word extends Model
{
     protected $fillable = [
        'word',
    ];
    
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
