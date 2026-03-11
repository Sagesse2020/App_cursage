<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{

protected $fillable = [
'vente_id',
'chemin_fichier',
'type'
];

public function vente()
{
return $this->belongsTo(Vente::class);
}

}
