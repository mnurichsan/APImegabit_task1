<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'id_user'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
