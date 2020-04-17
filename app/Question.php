<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['title', 'body'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value = null)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    public function getUrlAttribute()
    {
        return route("questions.show", $this->id);
    }
    public function getCreateDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute()
    {
        return $this->answers > 0 ? 
            ( $this->best_answer_id ? 
                'unanswered'
                : 'answered' )
            : 'unanswered';
        // if ($this->answers > 0) {
        //     # code...
        // }
    }
}
