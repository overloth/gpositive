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
    	'author',
    	'category',
    	'video',
    	'body',
    	'tags',
    	'comments'
    ];
}
