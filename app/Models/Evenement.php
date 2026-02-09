<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
     protected $fillable=['titre','description','date_event','user_id'];
}
