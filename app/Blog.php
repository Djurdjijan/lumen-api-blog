<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $table="blog_posts";
    protected $fillable = [
        'post_content', 'user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
