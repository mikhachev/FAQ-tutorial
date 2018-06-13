<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    const WAITING = 1;
    const PUBLISHED = 2;
    const HIDDEN = 3;
    const BLOCKED = 4;

    protected $fillable = [
        'name',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function questionsWaiting()
    {
        return $this->questions()->where('status_id', Theme::WAITING);
    }

    public function questionsPublished()
    {
        return $this->questions()->where('status_id', Theme::PUBLISHED);
    }

    public function questionsHidden()
    {
        return $this->questions()->where('status_id', Theme::HIDDEN);
    }

    /* public function questionsBlocked()
    {
        return $this->questions()->where('status_id', 4);
    }*/

    public function delete()
    {
        foreach ($this->questions as $q) {
            $q->delete();
        }
        parent::delete();
    }
}
