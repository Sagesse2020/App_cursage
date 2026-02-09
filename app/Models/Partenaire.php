<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $fillable = [ 'user_id','nom','telephone','email','adresse','pourcentage_commission','notes'];

    public function chiens()
    {
        return $this->hasMany(Chien::class);
    }

    public function user()
    {
         return $this->belongsTo(User::class); 
    }
}
