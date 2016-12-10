<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //mass assign
    protected $fillable = [
        'text',
        'user_id',
        'article_id'
    ];
    

    /**
     * Get the article that has this comment.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    /**
     * Get the user that has this comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
