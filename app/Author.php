<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    
    /**
     * Get the articles for the author.
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    /**
     * Get the user for the author.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function workshops()
    {
        return $this->hasMany('App\Workshop');
    }
}
