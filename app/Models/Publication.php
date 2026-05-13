<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{

    protected $fillable = ['titre','contenu','image','user_id'];

    // Relation vers l'utilisateur qui a publié
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}

}
