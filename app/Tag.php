<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
protected $fillable = [
	'name'    	
    ];

    /**
     * Returns artcles related to this tag
     */
     
    public function articles()
    {
    	return $this->belongsToMany('App\Article');
    }
}
