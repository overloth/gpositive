<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
    	'title',
    	'description',
    	'price',
        'image'
    ];

    /**
     * Get the articles for the course.
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
