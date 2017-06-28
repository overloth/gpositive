<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
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
        'author_id'
        
    ];

    
    /**
     * Get the author that wrote the article.
     */
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

   

}
