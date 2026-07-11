<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProduitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
   public function view(User $user, Produit $produit): bool
{


// Admin
if(
$user->role === 'admin'
&& $user->niveau_admin >= 1
){

return true;

}



if(!$user->partenaire_id){

return false;

}

return $produit->partenaire_id == $user->partenaire_id;


}
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->niveau_admin >= 2;
    }

    /**
     * Determine whether the user can update the model.
     */
public function update(User $user, Produit $produit)
{


if(
$user->role === 'admin'
&&
$user->niveau_admin >=2
)
{
    return true;
}


return $produit->partenaire_id == $user->partenaire_id;


}
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produit $produit): bool
    {
          if($user->niveau_admin == 3){
          return true;
          }

  return $produit->partenaire_id == $user->partenaire_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Produit $produit): bool
    {
          if($user->niveau_admin == 3){
        return true;
        }

    return $produit->partenaire_id == $user->partenaire_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Produit $produit): bool
    {
   
    }
}
