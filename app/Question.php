<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'author',
        'author_email',
        'theme_id',
        'name',
        'status_id',
        'user_id',
        'answer',
        'question_created',
        'answer_created',
        'answer_updated',

    ];

    public $timestamps = false;

    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function delete()
    {
        parent::delete();
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

