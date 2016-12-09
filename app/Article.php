<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
    	'title',
    	'description',
    	'price',
    	'image',
    	'category',
    	'video',
    	'body',
    	'tags',
        'author_id',
        'course_id'
    ];

    /**
     * Get the comments for the article.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the author that wrote the article.
     */
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    /**
     * Get the course that the article belongs to.
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

}
