<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Returns artcles related to this tag
     */
     
    public function articles()
    {
    	return $this->belongsToMany('App\Article');
    }
}
