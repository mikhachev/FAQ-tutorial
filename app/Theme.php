<?php
namespace App;

use Illuminate\Database\Eloquent\Model;



class Theme extends Model
{

    protected $fillable = [
        'name',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    
    public function questionsWaiting()
    {
        return $this->questions()->where('status_id', 1);
    }
    
    public function questionsPublished()
    {
        return $this->questions()->where('status_id', 2);
    }

    

    public function questionsHidden()
    {
        return $this->questions()->where('status_id', 3);
    }
    
    /* public function questionsBlocked()
    {
        return $this->questions()->where('status_id', 4);
    }*/


    public function delete()
    {
        foreach($this->questions as $q) {
            $q->delete();
        }

        parent::delete();
    }
}
